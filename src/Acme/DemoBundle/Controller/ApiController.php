<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JMS\DiExtraBundle\Annotation as DI;
use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /** @DI\Inject("doctrine.orm.entity_manager") */
    private $em;

    /**
     * @Route("/users", name="acme_users_get_all")
     * @Rest\View
     * @Method({"GET"})
     */
    public function getUsersAction()
    {
        $users = $this->em->getRepository('AcmeDemoBundle:User')->findAll();

        return array(
            'users' => $users,
        );
    }

    /**
     * @Route("/books", name="acme_books_get_all")
     * @Rest\View
     * @Method({"GET"})
     */
    public function getBooksAction()
    {
        $books = $this->em->getRepository('AcmeDemoBundle:Book')->findAll();

        return array(
            'books' => $books,
        );
    }

    /**
     * @Route("/users/{id}", requirements={"id" = "\d+"}, name="acme_users_get")
     * @Rest\View
     * @Rest\Get
     */
    public function getUserAction($id)
    {
        $user = $this->em->getRepository('AcmeDemoBundle:User')->find($id);

        if (!$user instanceof User) {
            throw new NotFoundHttpException('User not found');
        }

        return array(
            'user' => $user,
        );
    }

    /**
     * @Route("/users")
     * @Method({"POST"})
     */
    public function newUserAction()
    {
        return $this->processForm(new User());
    }

    private function processForm(User $user) 
    {
        $statusCode = $user->isNew() ? 201 : 204;

        $form = $this->createForm(new UserType(), $user);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();

            $response = new Response();
            $response->setStatusCode($statusCode);

            if (201 === $statusCode) {
                $response->headers->set('Location',
                    $this->generateUrl(
                        'acme_users_get',
                        array('id' => $user->getId()),
                        true
                    )
                );
            }

            return $response;
        }

        return View::create($form, 400);
    }

    /**
     * @Route("/users/{id}"), requirements={"id" = "\d+"}, name="acme_users_edit"
     * @Method({"PUT"})
     */
    public function editUserAction($id)
    {
        if (null === $user = $this->em->getRepository('AcmeDemoBundle:User')->find($id)) {
            $user = new User();
        }
        return $this->processForm($user);
    }

    /**
     * @Route("/users/{id}"), requirements={"id" = "\d+"}, name="acme_users_delete"
     * @Method({"DELETE"})
     * @Rest\View(statusCode=204)
     */
    public function deleteUserAction($id)
    {
        $user = $this->em->getRepository('AcmeDemoBundle:User')->find($id);

        $this->em->remove($user);
        $this->em->flush();
    }

}

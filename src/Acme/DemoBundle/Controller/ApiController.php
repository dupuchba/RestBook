<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JMS\DiExtraBundle\Annotation as DI;
use Acme\DemoBundle\Entity\User;

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
     */
    public function getUsersAction()
    {
        $users = $this->em->getRepository('AcmeDemoBundle:User')->findAll();

        return array(
            'users' => $users,
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
     * @Template()
     */
    public function newUserAction()
    {
    }

    /**
     * @Route("/users/{id}")
     * @Template()
     */
    public function editUserAction($id)
    {
    }

    /**
     * @Route("/users/{id}")
     * @Template()
     */
    public function deleteUserAction($id)
    {
    }

}

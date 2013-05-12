<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends Controller
{
    /**
     * @Route("/api/users")
     * @Rest\View
     */
    public function getUsersAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AcmeDemoBundle:User')->findAll();

        return array(
            'users' => $users,
        );
    }

    /**
     * @Route("/api/users/{id}")
     * @Template()
     */
    public function getUserAction($id)
    {
    }

    /**
     * @Route("/api/users")
     * @Template()
     */
    public function newUserAction()
    {
    }

    /**
     * @Route("/api/users/{id}")
     * @Template()
     */
    public function editUserAction($id)
    {
    }

    /**
     * @Route("/api/users/{id}")
     * @Template()
     */
    public function deleteUserAction($id)
    {
    }

}

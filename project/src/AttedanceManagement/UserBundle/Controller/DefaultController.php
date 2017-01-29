<?php

namespace AttedanceManagement\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/login")
     * @Template("AttedanceManagementUserBundle:Security:login.html.twig")
     */
    public function loginAction()
    {
        return [];
    }
}

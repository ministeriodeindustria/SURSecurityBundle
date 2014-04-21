<?php

namespace SUR\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class SecuredController extends Controller
{
    /**
     * @Route("/logout", name="_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * @Route("/login", name="_login")
     */
    public function surAction()
    {
        // The security layer will intercept this request
//     	$this->getRequest()->getSession()->clear();
//     	$this->getRequest()->getSession()->invalidate();
    	return new Response('', 302, array("Location" =>  $this->container->getParameter('login_url')));
    }
}

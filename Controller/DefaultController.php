<?php

namespace SUR\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SUR\SecurityBundle\Entity\Nodo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function menuAction()
    {
//     	$nodoDAO = $this->getDoctrine()->getRepository('SURSecurityBundle:Nodo');
//     	$menu = $nodoDAO->findHeaders(); //FIXME Recuperar el Id de Usuario logueado
    
    	$menu = $this->buildMockMenu();
    	
    	return array('menu' => $menu);
    }
    
    private function buildMockMenu(){
    	$m1 = new Nodo();
    	$m1->setNodoArchivo("#");
    	$m1->setNodoNombre("Menu 1");
	    	$m11 = new Nodo();
	    	$m11->setNodoArchivo("acme_hello_projects");
	    	$m11->setNodoNombre("Menu 1.1");
	    	$m1->addHijo($m11);
	    	$m12 = new Nodo();
	    	$m12->setNodoArchivo("acme_hello_projects_add");
	    	$m12->setNodoNombre("Menu 1.2");
	    	$m1->addHijo($m12);
	    	
    	$m2 = new Nodo();
    	$m2->setNodoArchivo("#");
    	$m2->setNodoNombre("Menu 2");
	    	$m21 = new Nodo();
	    	$m21->setNodoArchivo("acme_hello_employees");
	    	$m21->setNodoNombre("Menu 2.1");
	    	$m2->addHijo($m21);
	    	
	    return array($m1, $m2);
    }
}

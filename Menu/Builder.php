<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace SUR\SecurityBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\ORM\EntityManager;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
    	$usermenu = $this->container->get('security.context')->getToken()->getUser()->getMenu();
    	
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav');
 		
    	$menu->addChild('Inicio', array('route' => '_inicio'));
    	
	 	$this->addMenu($usermenu, $menu);

//		$menu["ABMs"]->addChild("Menu 1", array('route' => '_menu1'));
 //       $menu["ABMs"]->addChild("Menu 2", array())->setAttribute('dropdown', true)->setAttribute('class', 'has-sub');
//		$menu["ABMs"]["Menu 2"]->addChild("Menu 2.1", array('route' => '_menu2'));
		
		return $menu;
    }
    
    private function addMenu($usermenu, &$menu){
    	if(!is_array($usermenu->item)){
    		$usermenu->item = array($usermenu->item);
    	}
    	
    	foreach ($usermenu->item as $m){
    		if(empty($m->hijos->item)){
    			$menu->addChild($m->nombre, array('route' => $m->archivo));
    		}else{
    			$menu->addChild($m->nombre, array())->setAttribute('class', 'has-sub');
		 		$this->addMenu($m->hijos, $menu[$m->nombre]);
    		}
    	}
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav pull-right');

    	/*
    	You probably want to show user specific information such as the username here. That's possible! Use any of the below methods to do this.

    	if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {} // Check if the visitor has any authenticated roles
    	$username = $this->container->get('security.context')->getToken()->getUser()->getUsername(); // Get username of the current logged in user

    	*/	
		$menu->addChild('User', array('label' => 'Hi visitor'))
			->setAttribute('dropdown', true)
			->setAttribute('icon', 'icon-user');

		$menu['User']->addChild('Edit profile', array('route' => 'acme_hello_profile'))
			->setAttribute('icon', 'icon-edit');

        return $menu;
    }
}
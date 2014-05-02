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
    	$token = $this->container->get('security.context')->getToken();
    	
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav');

    	$menu->addChild('Inicio', array('route' => '_inicio'));

	 	$this->addMenu($token->getUser()->getMenu(), $menu, $token->getAccessStrategy());

		return $menu;
    }

    private function addMenu($usermenu, &$menu, $accessStrategy){
    	if(!isset($usermenu->item)){
    		return;
    	}    	
    	if(!is_array($usermenu->item)){
    		$usermenu->item = array($usermenu->item);
    	}

    	foreach ($usermenu->item as $m){
    		if(empty($m->hijos->item)){
    			if($accessStrategy->hasAccess($m->archivo)){
	    			$menu->addChild($m->nombre, array('route' => $m->archivo));
    			}
    		}else{
    			$menu->addChild($m->nombre, array())->setAttribute('class', 'has-sub');
		 		$this->addMenu($m->hijos, $menu[$m->nombre]);
		 		
		 		//Si el menu quedo vacio, lo elimino
		 		if(sizeof($menu[$m->nombre]) == 0){
		 			$menu->removeChild($m->nombre);
		 		}
    		}
    	}
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav pull-right');

		$menu->addChild('User', array('label' => 'Hi visitor'))
			->setAttribute('dropdown', true)
			->setAttribute('icon', 'icon-user');

		$menu['User']->addChild('Edit profile', array('route' => 'acme_hello_profile'))
			->setAttribute('icon', 'icon-edit');

        return $menu;
    }
}
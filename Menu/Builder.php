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

	 	$this->addMenu($token->getUser()->getMenu(), $menu, $token->getUser()->getAccessStrategy());

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
		 		$this->addMenu($m->hijos, $menu[$m->nombre], $accessStrategy);
		 		
		 		//Si el menu quedo vacio, lo elimino
		 		if(sizeof($menu[$m->nombre]) == 0){
		 			$menu->removeChild($m->nombre);
		 		}
    		}
    	}
    }
}
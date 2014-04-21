<?php

namespace SUR\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use SUR\SecurityBundle\Security\Factory\SURFactory;

class SURSecurityBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
	
		$extension = $container->getExtension('security');
		$extension->addSecurityListenerFactory(new SURFactory());
	}
}

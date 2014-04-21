<?php
namespace SUR\SecurityBundle\Security\Factory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;

class SURFactory implements SecurityFactoryInterface
{
	public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
	{
		$providerId = 'security.authentication.provider.sur.'.$id;
		$container->setDefinition($providerId, new DefinitionDecorator('sur.security.authentication.provider'))
				  ->replaceArgument(0, new Reference($userProvider));

		$listenerId = 'security.authentication.listener.sur.'.$id;
		$listener = $container->setDefinition($listenerId, new DefinitionDecorator('sur.security.authentication.listener'));

		return array($providerId, $listenerId, $defaultEntryPoint);
	}

	public function getPosition()
	{
		return 'pre_auth';
	}

	public function getKey()
	{
		return 'sur';
	}

	public function addConfiguration(NodeDefinition $node)
	{
	}
}
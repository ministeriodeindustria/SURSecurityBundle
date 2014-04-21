<?php
namespace SUR\SecurityBundle\Security\User;

use BeSimple\SoapBundle\Soap\SoapClientBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class SURUserWebService{
	private $container;
	
	public function __construct(Container $container) {
		$this->container = $container;
	}
	
	public function getUserByToken($token){
		$clientBuilder = new SoapClientBuilder( $this->container->getParameter('ws_url'), array(
				'debug'      => false,
				'cache_type' => null,
				'exceptions' => true,
				'user_agent' => 'BeSimpleSoap'
		));
		$client = $clientBuilder->build();
		$user = $client->getUserByToken($token);

		return $user;
	}
}
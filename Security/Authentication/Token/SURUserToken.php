<?php
namespace SUR\SecurityBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class SURUserToken extends AbstractToken{

	private $tokenKey;
	
	public function __construct($user, $tokenKey, array $roles = array())
	{
		parent::__construct($roles);

		$this->setUser($user);
		$this->tokenKey = $tokenKey;
		
		// If the user has roles, consider it authenticated
		$this->setAuthenticated(count($roles) > 0);
	}

	public function getCredentials()
	{
		return $this->tokenKey;
	}
}
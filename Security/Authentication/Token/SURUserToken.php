<?php
namespace SUR\SecurityBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class SURUserToken extends AbstractToken{

	private $tokenKey;
	private $accessStrategy;
	
	public function __construct($user, $tokenKey, array $roles = array(), $accessStrategy)
	{
		parent::__construct($roles);

		$this->setUser($user);
		$this->tokenKey = $tokenKey;
		
		// If the user has roles, consider it authenticated
		$this->setAuthenticated(count($roles) > 0);
		
		$this->accessStrategy = $accessStrategy;
	}

	public function getCredentials()
	{
		return $this->tokenKey;
	}
	
	public function getRoles() {
		$accesibleRoles = array();
		foreach (parent::getRoles() as $role){
			if($this->getUser()->getAccessStrategy()->hasAccess($role->getRole())){
				$accesibleRoles[] = $role;
			}
		}
		
		return $accesibleRoles;
	}

}
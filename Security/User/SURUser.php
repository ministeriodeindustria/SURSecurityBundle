<?php
namespace SUR\SecurityBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class SURUser implements UserInterface, EquatableInterface
{
	private $username;
	private $roles;
	private $menu;

	public function __construct($username, array $roles, $menu)
	{
		$this->username = $username;
		$this->roles = $roles;
		$this->menu = $menu;
	}

	public function getRoles()
	{
		return $this->roles;
	}

	public function getMenu()
	{
		return $this->menu;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getPassword(){}
	public function getSalt(){}
	
	public function eraseCredentials()
	{
	}

	public function isEqualTo(UserInterface $user)
	{
		if (!$user instanceof SURUser) {
			return false;
		}

		if ($this->username !== $user->getUsername()) {
			return false;
		}

		return true;
	}
}
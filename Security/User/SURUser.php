<?php
namespace SUR\SecurityBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use SUR\SecurityBundle\Security\Helper\DefaultAccessStrategy;

class SURUser implements UserInterface, EquatableInterface
{
	private $username;
	private $id;
	private $codigoUsuario;
	private $nroDocumento;
	private $nombre;
	private $apellido;
	private $mail;
	public $sistemaId;
	private $roles;
	private $menu;
	private $accessStrategy;
	private $empresa;

	public function __construct($user, array $roles, $menu, $accessStrategy = NULL)
	{
		$this->username = $user->usuApellido . ', ' . $user->usuNombre;
		$this->apellido = $user->usuApellido;
		$this->nombre = $user->usuNombre;
		$this->mail = $user->usuEmail;
		$this->sistemaId = $user->sistemaId;
		$this->codigoUsuario = $user->usuUsuario;
		$this->id = $user->usuId;
		$this->nroDocumento = $user->usuNumDoc;
		$this->empresa = $user->empresa;

		$this->roles = $roles;
		$this->menu = $menu;

		$this->accessStrategy = $accessStrategy === NULL ? new DefaultAccessStrategy() : $accessStrategy;
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


	public function setAccessStrategy($accessStrategy){
		$this->accessStrategy = $accessStrategy;
	}

	public function getAccessStrategy(){
		return $this->accessStrategy;
	}
}

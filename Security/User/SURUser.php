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
	private $sistemaId;
	private $roles;
	private $menu;
	private $accessStrategy;

	public function __construct($user, array $roles, $menu, $accessStrategy = NULL)
	{
		$this->username = $user->usuIntraApellido . ', ' . $user->usuIntraNombre;
		$this->$apellido = $user->usuIntraApellido;
		$this->$nombre = $user->usuIntraNombre;
		$this->$mail = $user->usuIntraMail;
		$this->$sistemaId = $user->sistemaId;
		$this->$codigoUsuario = $user->usuIntraUsuario;
		$this->$id = $user->usuIntraId;
		$this->$nroDocumento = $user->usuIntraNumDoc;

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
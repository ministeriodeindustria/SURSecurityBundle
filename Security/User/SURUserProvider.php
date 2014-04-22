<?php
namespace SUR\SecurityBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Doctrine\ORM\EntityManager;

class SURUserProvider implements UserProviderInterface
{
	private $authService;

	public function __construct($authService)
	{
		$this->authService = $authService;
	}

	public function loadUserByToken($token)
	{
		//FIXME Invocar el WS de SUR
 		$respuesta = $this->authService->getUserByToken($token);
// 		$user = true;

		//FIXME tmp
		if($respuesta->status==$respuesta->OK){
			$roles = array('INICIO');
			$user = new SURUser($respuesta->user->usuIntraUsuario, $roles, $respuesta->user->menu);
			return $user;
		}

		return false;
	}

	public function loadUserByUsername($username){}
	public function refreshUser(UserInterface $user){ return $user; }

	public function supportsClass($class)
	{
		return $class === 'Acme\DemoBundle\Security\User\SURUser';
	}
}
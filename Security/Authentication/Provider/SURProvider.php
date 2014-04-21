<?php
namespace SUR\SecurityBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use SUR\SecurityBundle\Security\Authentication\Token\SURUserToken;
use SUR\SecurityBundle\Security\User\SURUserProvider;

class SURProvider implements AuthenticationProviderInterface
{
	private $userProvider;

	public function __construct(SURUserProvider $userProvider)
	{
		$this->userProvider = $userProvider;
	}

	public function authenticate(TokenInterface $token)
	{
		$token = $token->getCredentials();
		$user = $this->userProvider->loadUserByToken($token);
		
		//FIXME Validar tiempo de expiracion de la session de SUR?
		if (!$user) {
			throw new AuthenticationException(
					sprintf('Token "%s" inexistente.', $token)
			);
		}
// 		$user = $this->userProvider->loadUserByUsername($username);
		
		$authenticatedToken = new SURUserToken($user, $token, $user->getRoles());
		return $authenticatedToken;

		throw new AuthenticationException('Fallo la autenticacion con SUR.');
	}

	public function supports(TokenInterface $token)
	{
		return $token instanceof SURUserToken;
	}
}
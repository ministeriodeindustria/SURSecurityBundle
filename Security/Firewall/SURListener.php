<?php
namespace SUR\SecurityBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use SUR\SecurityBundle\Security\Authentication\Token\SURUserToken;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class SURListener implements ListenerInterface
{
	protected $securityContext;
	protected $authenticationManager;
	protected $container;

	public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager,Container $container)
	{
		$this->securityContext = $securityContext;
		$this->authenticationManager = $authenticationManager;
		$this->container = $container;
	}

	public function handle(GetResponseEvent $event)
	{
		$request = $event->getRequest();

		if($this->securityContext->getToken() != NULL && $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')){
			if($this->securityContext->getToken()->getUser()->sistemaId == $this->container->getParameter('sistemaId')){
				return;
			}else if(!$request->query->has("token")){
				throw new AuthenticationCredentialsNotFoundException('A new session was opened by another application.');
			}
		}else if(!$request->query->has("token")){
			return;
		}
		
		try {

			$token = new SURUserToken("ANONIMO", $request->query->get("token"));
			$authToken = $this->authenticationManager->authenticate($token);
			$this->securityContext->setToken($authToken);

			return;
		} catch (AuthenticationException $failed) {
			// ... you might log something here

			// To deny the authentication clear the token. This will redirect to the login page.
			// Make sure to only clear your token, not those of other authentication listeners.
			// $token = $this->securityContext->getToken();
			// if ($token instanceof WsseUserToken && $this->providerKey === $token->getProviderKey()) {
			//     $this->securityContext->setToken(null);
			// }
			// return;
			$this->securityContext->setToken(null);
			return;
			// Deny authentication with a '403 Forbidden' HTTP response
			$response = new Response();
			$response->setStatusCode(Response::HTTP_FORBIDDEN);
			$event->setResponse($response);

		}

		// By default deny authorization
		$response = new Response();
		$response->setStatusCode(Response::HTTP_FORBIDDEN);
		$event->setResponse($response);
	}
}

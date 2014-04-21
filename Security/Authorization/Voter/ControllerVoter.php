<?php
namespace SUR\SecurityBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Doctrine\ORM\EntityManager;

class ControllerVoter implements VoterInterface{
	
  	private $em;
  	
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
	
	public function supportsAttribute($attribute)
	{
		// you won't check against a user attribute, so return true
		return true;
// 		return $attribute->;
	}
	
	public function supportsClass($class)
	{
		// your voter supports all type of token classes, so return true
		return true;
	}
	

	
	public function vote(TokenInterface $token, $object, array $attributes)
	{
		$result = VoterInterface::ACCESS_ABSTAIN;
        /*$user = $token->getUser();
        
//         foreach ($attributes as $attribute) {
//             if (!$this->supportsAttribute($attribute)) {
//                 continue;
//             }

        	$controller = explode(":", $object->get("_controller"));
			$access = $controller[0];
        	
			if($access == "Symfony\Bundle\FrameworkBundle\Controller\RedirectController"){
	                return VoterInterface::ACCESS_GRANTED;
			}
			
        	foreach ($token->getRoles() as $role){
        		if($role->getRole() == $access){
	                return VoterInterface::ACCESS_GRANTED;
        		}
        	}	

            $result = VoterInterface::ACCESS_DENIED;
*/
        return $result;
	}
}
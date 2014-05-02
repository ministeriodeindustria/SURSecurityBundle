<?php
namespace SUR\SecurityBundle\Security\Helper;

class DefaultAccessStrategy implements IAccessStrategy {

	public function hasAccess($role) {
		return true;
	}

}

<?php
namespace SUR\SecurityBundle\Security\Helper;


interface IAccessStrategy{
	public function hasAccess($role);
}
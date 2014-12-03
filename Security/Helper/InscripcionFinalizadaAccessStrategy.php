<?php
namespace SUR\SecurityBundle\Security\Helper;

class InscripcionFinalizadaAccessStrategy implements IAccessStrategy {

	public function hasAccess($role) {
		return $role!='_inscripcion';
	}

}

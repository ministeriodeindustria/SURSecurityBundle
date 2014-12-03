<?php
namespace SUR\SecurityBundle\Security\Helper;

class InscripcionAccessStrategy implements IAccessStrategy {

  public function hasAccess($role) {
    return $role=='_inscripcion';
  }
  
}

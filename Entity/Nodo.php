<?php 
namespace SUR\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nodo
 *
 * @ORM\Table(name="nodo")
 * @ORM\Entity
 */
class Nodo{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="nodo_id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $nodo_id;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="nodo_nombre", type="string", length=100, nullable=false)
	 */
	private $nodo_nombre;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="nodo_archivo", type="string", length=100, nullable=false)
	 */
	private $nodo_archivo;
	

	//FIXME Aca van las aristas con sus nodos hijos
	protected $hijos;
	
	public function getNodoId() {
		return $this->nodo_id;
	}
	public function setNodoId($nodo_id) {
		$this->nodo_id = $nodo_id;
		return $this;
	}
	public function getNodoNombre() {
		return $this->nodo_nombre;
	}
	public function setNodoNombre($nodo_nombre) {
		$this->nodo_nombre = $nodo_nombre;
		return $this;
	}
	public function getNodoArchivo() {
		return $this->nodo_archivo;
	}
	public function setNodoArchivo($nodo_archivo) {
		$this->nodo_archivo = $nodo_archivo;
		return $this;
	}
	public function getHijos(){
		return $this->hijos;
	}
	public function addHijo($nodo){
		$this->hijos[] = $nodo;
	}
	
}
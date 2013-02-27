<?php

class Person {
	private $name;

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}
  
	public function theName(){
		echo $this->name;
	}
}

$p1 = new Person();
$p1 -> setName('Juan');
$theperson = $p1 -> getName();


/*
 * Private
 * Los elementos declarados como Private son accesibles sólo desde la misma clase donde fueron definidos.
 * No se puede acceder al elemento desde una instancia
 */


?>

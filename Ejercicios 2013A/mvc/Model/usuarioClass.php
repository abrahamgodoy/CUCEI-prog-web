<?php

class usuarioClass{

	public $id;
	public $nombre;
	public $pass;
	public $mail;
	public $privilegio;
	
	function __construct($id, $nombre, $pass, $mail, $privilegio){
		$this->id 		= $id;
		$this->nombre 	= $nombre;
		$this->mail 	= $mail;
		$this->pass 	= $pass;
		$this->privilegio = $privilegio;
	}
e
}

<?php

/**
 * @subpackage controlador
 * 
 */
 
include_once 'Modelo/videojuegoMdl.php';

class VideojuegosCtrl{
	public $modelo;
	private $conexion;
	
	function __construct($conexion){
		$this->conexion = $conexion;
		$this -> modelo = new Videojuegos($this->conexion);
	}
	
	function ejecutar(){
		//if no hay parametros, listo usuarios
		
		if(!isset($_REQUEST['game'])){
			$videojuegos = $this->modelo->lista_videojuegos();
			//incluyo vista
			include_once('Vista/listaVideojuegosView.php');
		}
		else if(!isset($_REQUEST['game'])){
			$id_videojuego = $_REQUEST['game'];
			$videojuego = $this->modelo->obtener_videojuego($id_videojuego);
			
			include_once('Vista/videojuegosView.php');
		}
	}
}

?>

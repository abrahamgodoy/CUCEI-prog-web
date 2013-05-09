<?php

/**
 * @subpackage controlador
 * 
 */
 


class StdCtrl{
	
	private $conexion;
	
	function __construct(){
		require 'conexion/bd_info.inc';
		include_once 'Modelo/conexionMdl.php';
		$cn = new DB($dbhost, $dbuser, $dbpass, $db);
		$cn->conectar();
		$this->conexion = $cn;
	}
	/**
	 * @param string $ruta_plantilla con la ruta de la plantilla
	 * @param array $diccionario con las cadenas a reemplazar
	 * @return string $plantilla html ya procesado
   */
	function procesaPlantilla($ruta_plantilla,$diccionario){
		//Obtener el contenido del archivo
		$plantilla = file_get_contents($ruta_plantilla);

		//Reemplazar los tags de variables en html por variables de php
		$plantilla = str_replace(array_keys($diccionario), $diccionario, $plantilla);
		
		//Regresar la plantilla
		return $plantilla;
	}

	function ejecutar(){
		$tituloPagina = 'PORTAL VIDEOJUEGOS';
			$usuario = $this -> isLogin();
			//include_once 'Vista/portadaView.php';
			$valores = array('{titulo-pagina}' => 'Index',
											 '{autor}' => 'Michelle Torres');
			echo $this->procesaPlantilla('Vista/index.html',$valores);
	}
	
	function login(){
		session_start();
		
		if(isset($_SESSION['user'])){
			return TRUE;
		}
		return FALSE;
	}
	
	function isLogin(){
		if($this->login()){
				return $_SESSION['user'];
		}
		return 'inicie sesion';
	}
}

?>

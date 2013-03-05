<?php

class Conexion{

	function conectame(){
		
		//Cargo el archivo con los datos de conexion
		require_once('data_bd.inc');

		//Creo mi objeto para la conexion
		$mysqli = new mysqli($host, $user, $pass, $bd);

		//Debuggeando que si tenga un objeto
		var_dump($mysqli);
	}

}

$miConexion = new Conexion();
$miConexion -> conectame();

<?php

class productoBss{

	/**
	 * @return mixed, array $productos, en caso de falla FALSE
	 */
	function listar(){
		//Cargo los datos para la conexión
		include('db_data.inc');

		//Creo mi conexión
		$conexion = new mysqli($hostdb, $userdb, $passdb, $db);
		if($conexion->connect_errno)
			die('No se pudo conectar');
		
		//Creo mi query
		$consulta = "SELECT
						*
					 FROM
						producto";

		//Ejecuto la consulta
		$resultado = $conexion -> query($consulta);

		if($conexion->errno){
			$conexion -> close();	
			return FALSE;
		}

		//Cierro la conexion
		$conexion -> close();

		//Si el query no devolvio filas
		if ( !$resultado->num_rows > 0 )
			return FALSE;

		//Procesamos el resultado para convertirlo en un array
		while ( $fila = $resultado -> fetch_assoc() )
			$productos[] = $fila;

		//Regreso los productos
		return $productos;
	}
}

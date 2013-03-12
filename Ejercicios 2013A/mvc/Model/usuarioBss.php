<?php

/**
 * @package mvc
 * @subpackage model
 */

class usuarioBss{
	
	/**
	 * @param string $nombre
	 * @param string $mail
	 * @param string $pass encriptado md5
	 * @param int $privilegio indica el perfil de permisos
	 * @return mixed usuarioClass object y en caso de falla un FALSE
	 */
	function insertar($nombre,$mail,$pass,$privilegio){
		//Cargar clase usuario
		require('usuarioClass.php');
		
		//Conectarse a la base de datos
		require('dbdata.inc');
		require('dbClass.php');
		$conexion  = new DB($hostdb, $userdb, $passdb, $db); 
		if(!$conexion -> conecta())
			die('No se ha podido realizar la conexion a la bd');

		//Limpiar las variables recibidas
		$nombre = $conexion->limpiarVariable($nombre);
		$mail = $conexion->limpiarVariable($mail);
		$pass = $conexion->limpiarVariable($pass);
		$privilegio = $conexion->limpiarVariable($privilegio);

		//Crear el query
		$query = "INSERT INTO 
					usuario (nombre, mail, pass, privilegio)
				  VALUES 
					('$nombre',
					 '$mail',
					 '$pass',
					 $privilegio)";

		//Ejecutar el query
		$resultado = $conexion -> ejecutarConsulta($query);

		if($resultado == FALSE){
			echo 'FALLO la consulta';
			//Cerrar la conexion
			$conexion -> cerrar();
			return FALSE;
		}
		else{
			$id = $resultado;
			//Cerrar la conexion
			$conexion -> cerrar();

			//Arreglo del usuario
			$user = new usuarioClass($id, $nombre, $pass, $privilegio, $mail);
	
			return $user;
		}
	}

	/**
	 * @return mixed array with all the users, or FALSE in fail
	 */
	function listar(){
		//Conectarse a la base de datos
		require('dbdata.inc');
		require('dbClass.php');
		$conexion  = new DB($hostdb, $userdb, $passdb, $db); 

		if(!$conexion)
			die('LIST. No se ha podido realizar la conexion a la bd');

		//Crear el query
		$query = 'SELECT
					*
				  FROM
					usuario';

		//Ejecutar el query
		$resultado = $conexion -> ejecutarConsulta($query);

		if(!$resultado){
			echo 'FALLO la consulta';
			
			//Cerrar la conexion
			$conexion -> cerrar();
			return FALSE;
		}
		else{
			//Cerrar la conexion
			$conexion -> cerrar();

			return $resultado;			
		}
	}

	/**
	 * @param int $id del usuario
	 * @return object usuarioClass, FALSE en caso de falla
	 */
	function consultarPorId($id){
		//Cargar clase usuario
		require('usuarioClass.php');
		
		//Conectarse a la base de datos
		require('dbdata.inc');
		require('dbClass.php');
		$conexion  = new DB($hostdb, $userdb, $passdb, $db); 

		if(!$conexion)
			die('No se ha podido realizar la conexion a la bd');

		//Limpio las variables
		$id = $conexion->limpiarVariable($id);

		//Crear el query
		$query = 'SELECT
					*
				  FROM
					usuario
				  WHERE
					id = '.$id;

		//Ejecutar el query
		$resultado = $conexion -> ejecutarConsulta($query);

		if(!$resultado){
			echo 'FALLO la consulta';
			
			//Cerrar la conexion
			$conexion -> cerrar();
			return FALSE;
		}
		else{
			//Cerrar la conexion
			$conexion -> cerrar();
			
			if ($resultado[0]['id'] == $id ){
				$user = new usuarioClass($resultado[0]['id'],$resultado[0]['nombre'],$resultado[0]['mail'],$resultado[0]['pass'],$resultado[0]['privilegio']);
				return $user;
			}
			else
				return FALSE;			
		}
	}
}
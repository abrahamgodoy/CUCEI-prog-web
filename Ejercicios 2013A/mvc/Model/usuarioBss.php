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
		//Conectarse a la base de datos
		require('dbdata.inc');
		@$conexion  = new mysqli($hostdb, $userdb, $passdb, $db); 

		if($conexion -> connect_errno)
			die('No se ha podido realizar la conexion a la bd'.$conexion->connect_error);

		//Limpiar las variables recibidas
		$nombre 		= $conexion->real_escape_string($nombre);
		$mail 			= $conexion->real_escape_string($mail);
		$pass 			= $conexion->real_escape_string($pass);
		$privilegio 	= $conexion->real_escape_string($privilegio);

		//Crear el query
		$query = "INSERT INTO 
					usuario (nombre, mail, pass, privilegio)
				  VALUES 
					('$nombre',
					 '$mail',
					 '$pass',
					 $privilegio)";

		//Ejecutar el query
		$conexion -> query($query);

		if($conexion->errno){
			echo 'FALLO '.$conexion->errno.' : '.$conexion->error;
			//Cerrar la conexion
			$conexion -> close();
			return FALSE;
		}
		else{
			$id = $conexion->insert_id;
			//Cerrar la conexion
			$conexion -> close();

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
		@$conexion  = new mysqli($hostdb, $userdb, $passdb, $db); 

		if($conexion -> connect_errno)
			die('LIST. No se ha podido realizar la conexion a la bd'.$conexion->connect_error);

		//Crear el query
		$query = 'SELECT
					*
				  FROM
					usuario';

		//Ejecutar el query
		$resultado = $conexion -> query($query);

		if($conexion->errno){
			echo 'FALLO '.$conexion->errno.' : '.$conexion->error;
			//Cerrar la conexion
			$conexion -> close();
			return FALSE;
		}
		else{
			//Cerrar la conexion
			$conexion -> close();

			while ($fila = $resultado -> fetch_assoc())
				$usuarios[] = $fila;
			
			return $usuarios;			
		}
	}

	/**
	 * @param int $id del usuario
	 * @return object usuarioClass, FALSE en caso de falla
	 */
	function consultarPorId($id){
		//Conectarse a la base de datos
		require('dbdata.inc');
		@$conexion  = new mysqli($hostdb, $userdb, $passdb, $db); 

		if($conexion -> connect_errno)
			die('CONS. No se ha podido realizar la conexion a la bd'.$conexion->connect_error);

		//Limpio las variables
		$id = $conexion->real_escape_string($id);

		//Crear el query
		$query = 'SELECT
					*
				  FROM
					usuario
				  WHERE
					id = '.$id;

		//Ejecutar el query
		$resultado = $conexion -> query($query);

		if($conexion->errno){
			echo 'FALLO '.$conexion->errno.' : '.$conexion->error;
			//Cerrar la conexion
			$conexion -> close();
			return FALSE;
		}
		else{
			//Cerrar la conexion
			$conexion -> close();

			$fila = $resultado -> fetch_assoc();
			
			if ($fila['id'] == $id ){
				$user = new usuarioClass($fila['id'],$fila['nombre'],$fila['mail'],$fila['pass'],$fila['privilegio']);
				return $user;
			}
			else
				return FALSE;			
		}
	}
}
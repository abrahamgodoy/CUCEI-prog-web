<?php 

/**
 * @package Ejercicios2013A
 * @subpackage claseUsuario
 * @author Michelle Torres <lic.nancy.torres@gmail.com>
 * @version 1.0
 */

class Usuario{
	//Atributos
	private $id;
	private $nombre;
	private $mail;
	private $pass;
	private $privilegio;

	//Métodos
	/**
	 * @param string $nombre
	 * @param string $mail
	 * @param string $pass encriptado md5
	 * @param int $privilegio indica el perfil de permisos
	 * @return mixed $int con el id y en caso de falla un FALSE
	 */
	function insertarUsuario($nombre,$mail,$pass,$privilegio){
		//Asignar variables al objeto
		$this -> nombre 		= $nombre;
		$this -> mail 			= $mail;
		$this -> pass 			= $pass;
		$this -> privilegio 	= $privilegio;

		//Conectarse a la base de datos
		require_once('dbdata.inc');
		@$conexion  = new mysqli($hostdb, $userdb, $passdb, $db); 

		if($conexion -> connect_errno)
			die('No se ha podido realizar la conexion a la bd');

		//Crear el query
		$query = "INSERT INTO 
					usuario (nombre, mail, pass, privilegio)
				  VALUES 
					('$this->nombre',
					 '$this->mail,
					 '$this->pass',
					 $this->privilegio)";

		//Ejecutar el query
		$conexion -> query($query);

		if($conexion->errno){
			echo 'FALLO '.$conexion->errno.' : '.$conexion->error;
			//Cerrar la conexion
			$conexion -> close();
			return FALSE;
		}
		else{
			$this -> id = $conexion->insert_id;
			//Cerrar la conexion
			$conexion -> close();
			return $this -> id;
		}
	}

	/**
	 * @return mixed array with all the users, or FALSE in fail
	 */
	function consultar(){
		//Conectarse a la base de datos
		require_once('dbdata.inc');
		@$conexion  = new mysqli($hostdb, $userdb, $passdb, $db); 

		if($conexion -> connect_errno)
			die('No se ha podido realizar la conexion a la bd');

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
	 * @return boolean
	 */
	function consultarPorId($id){
		//Conectarse a la base de datos
		require_once('dbdata.inc');
		@$conexion  = new mysqli($hostdb, $userdb, $passdb, $db); 

		if($conexion -> connect_errno)
			die('No se ha podido realizar la conexion a la bd');

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
				$this -> id = $fila['id'];
				$this -> nombre = $fila['nombre'];
				$this -> mail = $fila['mail'];
				$this -> pass = $fila['pass'];
				$this -> privilegio = $fila['privilegio'];
				return TRUE;
			}
			else
				return FALSE;			
		}
	}
}

$nuevoUsuario = new Usuario();
//$nuevoUsuario -> insertarUsuario('juan','juan@gmail.com','1234',1);


//var_dump($nuevoUsuario -> consultar());

if ($nuevoUsuario -> consultarPorId(5))
	var_dump($nuevoUsuario);
?>

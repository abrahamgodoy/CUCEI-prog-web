<?php

/**
 * @package Ejercicios2013A
 * @supackage claseProducto
 * @author Michelle Torres <lic.nancy.torres@gmail.com>
 * @version 1.0
 */

class Producto{
	//Atributos
	private $id;
	private $nombre;
	private $descripcion;
	private $costo;
	private $precio;

	//Métodos

	/**
	 * @param string $nombre
	 * @param string $descripcion
	 * @param float $costo
	 * @param float $precio
	 * @return boolean
	 * 
	 * Esta función inserta un producto en la base de datos
	 * y en caso de exito, los datos del producto quedan 
	 * almacenados en el objeto.
	 */
	function inserta($nombre, $desc, $costo, $precio){
		//Se hace la llamada a la variable global conexion		
		global $conexion;

		//Asignar las variables al objeto
		$this -> nombre 		= $nombre;
		$this -> descripcion 	= $desc;
		$this -> costo 			= $costo;
		$this -> precio 		= $precio;

		//Generar el query
		$consulta = "INSERT INTO  
						producto(nombre,descripcion,costo,precio)
					 VALUES (
						'$this->nombre',
						'$this->descripcion',
						$this->costo,
						$this->precio
					)
					";

		//Ejecutar el query
		$conexion -> query($consulta);

		if($conexion->errno){
			echo 'ERROR: '.$conexion->error;
			$conexion -> close();
			return FALSE;
		}

		$this -> id = $conexion->insert_id;
		return TRUE;
	}

	/**
	 * 
	 * @param int $id
	 * @return boolean
	 * 
	 * Esta función busca un producto y en caso de encontrarlo
	 * los datos quedan almacenados en el objeto.
	 */
	function consultaPorId($id){
		//Se hace la llamada a la variable global conexion	
		global $conexion;
		$this -> id = $id;

		//Generar el query
		$consulta = "SELECT
						*
					 FROM
						producto
					 WHERE
						idproducto=$this->id
					";

		//Ejecutar el query
		$resultado = $conexion -> query($consulta);

		if($conexion->errno){
			echo 'ERROR: '.$conexion->error;
			$conexion -> close();
			return FALSE;
		}

		$fila = $resultado -> fetch_assoc();

		if($fila['idproducto'] = $id){
			$this -> nombre			= $fila['nombre'];
			$this -> descripcion	= $fila['descripcion'];
			$this -> costo			= $fila['costo'];
			$this -> precio			= $fila['precio'];
			return TRUE;
		}
			
	}
}

/******************** ESTO SERIA MI CONTROLADOR ************/
//Conectarse a la base de datos
require_once('db_data.inc');
$conexion = new mysqli($hostdb, $userdb, $passdb, $db);

if($conexion->connect_errno)
	die('No se pudo conectar a la bd');

//Crear una instancia del objeto para mandar a llamar la funcion
$objetoProducto = new Producto();

//Reviso lo que tiene el objeto despues de insertar
if($objetoProducto -> inserta('pasta','de coditos',1.5,1.8))
	var_dump($objetoProducto);

//Reviso lo que tiene el objeto despues de consultar
if($objetoProducto -> consultaPorId(1))
	var_dump($objetoProducto);

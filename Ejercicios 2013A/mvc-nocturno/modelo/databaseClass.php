<?php

class DB{
	private $host;
	private $user;
	private $pass;
	private $db;
	private $mysqli;
	public $error;
	public $auto_id_insertado;
	public $filas_modificadas;
	
	/**
	 * Asigna los valores que utilizará la conexion
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $db
	 */
	function __construct($host, $user, $pass, $db){
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
	}
	
	/**
	 * @return boolean
	 */
	function conectar(){
		$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
		
		//Validar que se haya realizado la conexion
		if($this->mysqli->connect_errno){
			//Definimos la cadena de error
			$this->error = $this->mysqli->connect_errno . ': '.$this->connect_error;
			return FALSE;
		}
		else{
			return TRUE;
		}		
	}
	
	/**
	 * @param string $consulta
	 * @return mixed
	 * Arreglo cuando sea un select
	 * verdadero en caso de que no haya falla y no sea select
	 * falso en caso de falla
	 */
	function ejecutarConsulta($consulta){
		$resultado = $this->mysqli->query($consulta);
		//Validando que sea un mysqli_result
		if ( is_object($resultado )){
			//Validamos que si existan filas
			if ( $resultado->num_rows >0 ){
				while ( $fila = $resultado -> fetch_assoc() ){
					$resultado_array[] = $fila;
				}
				return $resultado_array;
			}
		}
		//Caso de cualquier query no SELECT
		elseif($resultado === TRUE){
			//Asigno el ultimo id automatico insertado	
			$this->auto_id_insertado = $this->mysqli->insert_id;
			//Asigno la cantidad de filas modificadas
			$this->filas_modificadas =  $this->mysqli->affected_rows;
			return TRUE;	
		}
		//En caso de que haya fallado
		return FALSE;
	}
	
	/**
	 * @return boolean
	 */
	function cerrar(){
		return $this->mysqli->close();
	}
	
	/**
	 * @param string $variable
	 * @return string $variable
	 */
	 function limpiarVariable($variable){
	 	$variable =  $this->mysqli->real_escape_string($variable);
		return $variable;
	 }
}

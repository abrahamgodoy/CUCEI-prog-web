<?php
include_once 'Modelo/conexionMdl.php';

class DB{
	private $host;
	private $user;
	private $pass;
	private $db;
	private $conexion;
	
	function __construct($dbhost, $dbuser, $dbpass, $db){
		$this -> host = $dbhost;
		$this -> user = $dbuser;
		$this -> pass = $dbpass;
		$this -> db = $db;
	}
	
	/**
	 * @return mixed objeto mysql o false
	 */
	
	function conectar(){
		$cn = new mysqli($this->host, $this->user, $this->pass, $this->db);
		
		if($cn->connect_errno)
			return FALSE;
		
		$this -> conexion = $cn;
		return TRUE;
		
	}
	
	/**
	 * @return mixed 
	 * resultado de la consulta en forma de arreglo 
	 * false si falla
	 * si fue insert regresa id
	 * o numero de columnas afectadas
	 */
	function consultar($query){
		$result = $this->conexion->query($query);
		
		if($this->conexion->errno){
			echo $this->conexion->errno;
			return FALSE;
		}
		
		if(is_object($result)){ // si fue select
			if($result->num_rows > 0){
				while ($row = $result -> fetch_assoc()) {
					$result_array[] = $row;
				}
				return $result_array;
			}
			else{
				return 0;
			}
		}
		$pos = strpos($query, 'INSERT');
		if($pos === 0){
			return $this -> conexion -> insert_id;
		}
		$pos = strpos($query, 'UPDATE');
		if($pos === 0){
			return $result;
		}
		$pos = strpos($query, 'DELETE');
		if($pos === 0){
			return $result;
		}
		return $this -> conexion -> affected_rows;
	}
	
	/**
	 * @param $conexion Conexion a la base de datos
	 * @param $var variable a limpiar, puede ser cualquier tipo
	 * @return String devuelve la variable escapada
	 */
	
	function limpia_variable($var){
		return $this -> conexion -> real_escape_string($var);
	}
	
	/**
	 * @param $conexion Conexion a la base de datos
	 * @return boolean regresa verdadero si se cerro correctamente la conexion
	 */
	function cerrarConexion(){
		return $this -> conexion -> close();
		
	}
}

?>
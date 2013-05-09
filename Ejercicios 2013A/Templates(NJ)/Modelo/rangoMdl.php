<?php
	include_once 'Modelo/conexionMdl.php';
	
	class Rango extends DB{
		
		private $id_rango;
		private $nombre_rango;
		private $antiguedad;
		
		function __construct(){
			require 'conexion/bd_info.inc';
			parent::__construct($dbhost, $dbuser, $dbpass, $db);
			if(!$this -> conectar()){
				$mensaje = 'No se pudo conectar!';
				include_once 'Vista/mensajeView.php';
				exit;
			}
		}
		
		function insertar($nombre, $antiguedad, $imagen){
			$this->nombre_rango = $this->conexion->limpia_variable($nombre);
			$this->antiguedad = $this->conexion->limpia_variable($nombre);
			
			$archivos = new ArchivoServidor();
			
			$directorio_rangos = "";
			$extensiones = array('image/jpeg', 'image/png', 'image/gif');
			$tamanoMaximo = 1572864;
			$nombre = $nombre.'_'.date('Y-m-d|G-i-s');
			
			$guardado = $archivo->subir($nombre, $directorio_rangos, $imagen, $extensiones, $tamanoMaximo);
			
			if($guardado != TRUE){
				return $guardado;
			}
			
			$insert_rango_sql = "INSERT INTO
								 	rango
								 	(rango, antiguedad, imagen)
								 VALUES
								 	('$this->nombre_rango'
								 	'$this->antiguedad'
								 	'$nombre')";
			return $this->conexion->consultar($insert_rango_sql);
		}
		
		function eliminar($id_rango){
			if($this->obtener_rango($id_rango)!= 'error-rango'){
				$delete_rango_sql = "DELETE FROM
										rango
									WHERE
										id_rango = $this->id_rango";
				return $this->conexion->consultar($delete_rango_sql);
			}
			else{
				return 'error-rango';
			}
		}
		
		function modificar($id_rango, $nombre, $antiguedad){
			$rango = $this->obtener_rango($id_rango);
			$this->nombre_rango = $this->conexion->limpia_variable($nombre);
			$this->antiguedad = $this->conexion->limpia_variable($antiguedad);
			
			if($rango != 'error-rango'){
				$update_rango_sql = "UPDATE
										rango
									 SET
									 	rango = '$this->nombre_rango',
									 	antiguedad = '$this->antiguedad'
									 WHERE
										id_rango = $this->id_rango";
				return $this->conexion->consultar($update_rango_sql);
			}
			else{
				return $rango;
			}
		}
		
		function modificar_imagen($id_rango, $imagen){
			$rango = $this->obtener_rango($id_rango);
			
			if($rango != 'error-rango'){
				$archivos = new ArchivoServidor();
			
				$directorio_rangos = "";
				$extensiones = array('image/jpeg', 'image/png', 'image/gif');
				$tamanoMaximo = 1572864;
				$nombre = $nombre.'_'.date('Y-m-d|G-i-s');
				
				$guardado = $archivo->subir($nombre, $directorio_rangos, $imagen, $extensiones, $tamanoMaximo);
				
				if($guardado != TRUE){
					return $guardado;
				}
			
				$update_rango_sql = "UPDATE
								 		rango
								 	 SET
								 	 	imagen= '$nombre'
								 	 WHERE
								 	 	id_rango = $this->id_rango";
				return $this->conexion->consultar($update_rango_sql);
			}
			else{
				return $rango;
			}
		}
		
		function obtener_rango($id_rango){
			$rango_sql = "SELECT
							  *
						  FROM
						  	  rango
						  WHERE
						  	id_rango = $id_rango";
			$rango_res = $this->consultar($rango_sql);
			
			return $rango_res[0];
		}
		
		function obtener_rango_antiguedad($antiguedad){
			$rango_sql = "SELECT
							  *
						  FROM
						  	  rango
						  WHERE
						  	antiguedad <= $antiguedad";
			$rango_res = $this->consultar($rango_sql);
			
			return $rango_res[0];
		}
		
		function lista_rangos(){
			$rango_sql = 'SELECT
							  *
						  FROM
						  	  rango';
			$rango_res = $this->conexion->consultar($rango_sql);
			
			if(is_array($rango_res)){
				return $rango_res;
			}
			else{
				return 'error-rango';
			}
		}
	}
?>
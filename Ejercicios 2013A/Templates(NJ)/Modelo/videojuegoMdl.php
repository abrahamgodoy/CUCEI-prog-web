<?php
	include_once 'Modelo/conexionMdl.php';
	
	class Videojuegos extends DB{
		private $conexion;
		private $nombre;
		private $archivo;
		private $directorio;
		private $id_usuario;
		private $aprobado;
		private $descripcion;
		private $num_juegos;
		
		function __construct(){
			require 'conexion/bd_info.inc';
			parent::__construct($dbhost, $dbuser, $dbpass, $db);
			if(!$this -> conectar()){
				$mensaje = 'No se pudo conectar!';
				include_once 'Vista/mensajeView.php';
				exit;
			}
		}
		
		function inserta_juego($nombre, $archivo, $id_usuario){
			$this -> nombre = $this -> conexion -> limpia_variable($nombre);
			$this -> archivo = $archivo;
			$this -> nombre = $this -> conexion -> limpia_variable($id_usuario);
			$extension[] = 'application/x-shockwave-flash';
			
		}
		
		function eliminar_videojuego($id_videojuego){
			$pathVideojuegos = '';
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							    WHERE
							 	 	id_videojuegos = $id_videojuego";
			$videojuego_res = $this->consultar($videojuego_sql);
			$videojuego_res = $videojuego_res[0];
			
			include_once 'Modelo/archivoServidorMdl.php';
			$archivo = new ArchivoServidor();
			$eliminado = $archivo->eliminar($pathVideojuegos.$videojuego_res['archivo']);
			
			if(!$eliminado){
				return FALSE;
			}
			$videojuego_sql = "DELETE FROM 
									videojuegos
								WHERE 
									id_videojuegos = $id_videojuego";
			$videojuego_res = $this->consultar($videojuego_sql);
			return $videojuego_res;
		}
		
		function aprueba ($id_videojuego){
			$this -> id_videjuego = $videojuego;
			$this -> videojuego = $this -> conexion -> limpia_variable($id_videojuego);
			$videojuego_sql = "UPDATE 
									videojuegos
								SET  
									aprobado = 1
								WHERE 
									id_videojuegos = $this -> videojuego";
		   $videojuego_res = $this->conexion->consultar($videojuegos_sql);
		   
		   if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function desactivar ($id_videojuego){
			$this -> id_videjuego = $videojuego;
			$this -> videojuego = $this -> conexion -> limpia_variable($id_videojuego);
			$videojuego_sql = "UPDATE 
									videojuegos
								SET  
									aprobado = 2
								WHERE 
									id_videojuegos = $this -> videojuego";
		   $videojuego_res = $this->conexion->consultar($videojuegos_sql);
		   
		   if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function obtener_videojuego ($id_videojuego){
			$this -> id_videjuego = $videojuego;
			$this -> videojuego = $this -> conexion -> limpia_variable($id_videojuego);
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							    WHERE
							 	 	id_videojuegos = $this -> videjuego";
			$videojuego_res =  $this->conexion->consultar($videojuegos_sql);
			
			if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function lista_videojuegos (){
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos";
			$videojuego_res = $this->conexion->consultar($videojuegos_sql);
			
			if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function lista_videojuegos_usuario ($id_usuario){
			$videojuegos_sql = "SELECT
									*
								FROM
									videojuegos
								WHERE
									FK_id_usuarios = $id_usuario";
								
			$videojuego_res = $this->consultar($videojuegos_sql);
			
			return $videojuego_res;
		}
		
		function videojuegos_categoria ($id_categoria){
			$this -> id_categoria = $categoria;
			$this -> categoria = $this -> conexion -> limpia_variable($id_categoria);	
			$videojuegos_sql = "SELECT
									*
								FROM
									vdeojuegos_categorias
								WHERE
									FK_id_categorias = $this -> categoria";
								
			return $this->conexion->consultar($videojuegos_sql);
		}
		
		
		function lista_aprobados (){
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							 	 WHERE
							 	 	aprobado = 1";
			$videojuego_res = $this->conexion->consultar($videojuegos_sql);
			
			if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function lista_aprobados_usuario($id_usuario){
			$this -> id_usuario = $id_usuario;
			$this -> id_usuario = $this -> conexion -> limpia_variable($id_usuario);
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							 	 WHERE
							 	 	aprobado = 1
							 	 AND
							 	 	FK_id_usuarios = $this -> id_usuario";
			$videojuego_res = $this->conexion->consultar($videojuegos_sql);
			
			if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function lista_noAprobados(){
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							 	 WHERE
							 	 	aprobado = 2";
			$videojuego_res = $this->conexion->consultar($videojuegos_sql);
			
			if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function lista_noAprobados_usuario($id_usuario){
			$this -> id_usuario = $id_usuario;
			$this -> id_usuario = $this -> conexion -> limpia_variable($id_usuario);
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							 	 WHERE
							 	 	aprobado = 2
							 	 AND
							 	 	FK_id_usuarios = $this -> id_usuario";
			$videojuego_res = $this->conexion->consultar($videojuegos_sql);
			
			if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function juegos_nuevos(){
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							 	 WHERE
							 	 	aprobado = 0";
			$videojuego_res = $this->conexion->consultar($videojuegos_sql);
			
			if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function categorias_videojuegos ($id_videojuego){
			$this -> id_videjuego = $videojuego;
			$this -> videojuego = $this -> conexion -> limpia_variable($id_videojuego);
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos_categorias
							    WHERE
							 	 	FK_id_videojuegos = $this -> videjuego";
			$videojuego_res = $this->conexion->consultar($videojuegos_sql);
		   
		   if(is_array($videojuego_res)){
				return $videojuego_res;
			}
			else{
				return false;
			}
		}
		
		function aumentar_num_juegos ($id_videojuego){
			$this -> id_videjuego = $videojuego;
			$this -> videojuego = $this -> conexion -> limpia_variable($id_videojuego);
			$videojuego_sql = "SELECT
									*
							 	FROM
							 	 	videojuegos
							    WHERE
							 	 	id_videojuegos = $this -> videjuego";
			$videojuego_res =  $this->conexion->consultar($videojuegos_sql);
		}
		
		function obten_historiales(){
			$historial_sql="SELECT
								*
							FROM
								historial_juegos";
			return $this->consultar($historial_sql);
		}
		
		function obten_historial($id_historial){
			$historial_sql="SELECT
								*
							FROM
								historial_juegos
							WHERE
								id_historial = $id_historial";
			return $this->consultar($historial_sql);
		}
		
		function obten_historial_estadistica($id_estadistica){
			$historial_sql="SELECT
								*
							FROM
								historial_juegos
							WHERE
								FK_id_estadisticas = $id_estadistica";
			return $this->consultar($historial_sql);
		}
		
		function elimina_historial($id_historial){
			$historial_sql="DELETE FROM
								historial_juegos
							WHERE
								id_historial = $id_historial";
			return $this->consultar($historial_sql);
		}
		
		function elimina_historial_estadistica($id_estadistica){
			$historial_sql="DELETE FROM
								historial_juegos
							WHERE
								FK_id_estadisticas = $id_estadistica";
			return $this->consultar($historial_sql);
		}
	}
?>
<?php
include_once 'Modelo/conexionMdl.php';

    class Estadisticas extends DB{
		private $num_baneos;
		private $ultima_conexion;
		private $id_usuario;
		
		function __construct(){
			require 'conexion/bd_info.inc';
			parent::__construct($dbhost, $dbuser, $dbpass, $db);
			if(!$this -> conectar()){
				$mensaje = 'No se pudo conectar!';
				include_once 'Vista/mensajeView.php';
				exit;
			}
		}
		
		function consulta_estadistica($id_estadistica){
			$estadistica_sql = "SELECT
								*
							FROM
								estadisticas
							WHERE
								id_estadisticas = $id_estadistica";
			$estadistica_res = $this->consultar($estadistica_sql);
		   
		   	return $estadistica_res;
		}
		
		function consulta_estadistica_user($id_usuario){
			$usuario_sql = "SELECT
								*
							FROM
								estadisticas
							WHERE
								FK_id_usuarios = $usuario";
			$usuario_res = $this->consultar($usuarios_sql);
		   
		   	return $usuario_res[0];
		}
		
		function elimina_estadistica($id_estadistica){
			$estadistica_sql = "DELETE FROM
									estadisticas
								WHERE
									id_estadisticas = $id_estadistica";
			$estadistica_res = $this->consultar($id_usuario);
			
			return $estadistica_res;
		}
	
		function incrementa_baneo ($id_usuario){
			
		}
		
		function registra_conexion ($id_usuario){
			$fecha_actual = date('Y-m-d');
			$this->id_usuario=$this -> conexion -> limpia_variable($id_usuario);
			$estadisticas_sql = "SELECT
								*
							FROM
								estadisticas
							WHERE
								FK_id_usuarios = $this->id_usuario";
			$estadisticas_res = $this->conexion->consultar($estadisticas_sql);
			if(is_array($estadisticas_res)){
				$update_estadisticas_sql = "UPDATE
								 				estadisticas
								 	 		SET
								 	 			ultima_conexion = '$fecha_actual'
								 	 		WHERE
								 	 			FK_id_usuarios = $this->id_usuario";
				return $this->conexion->consultar($update_estadisticas_sql);
				//return $estadisticas_res;
			}
			else{
				return false;
			}
		}
		
		function lista_jugados ($id_usuario){
			$this -> id_usuario = $usuario;
			$this -> usuario = $this -> conexion -> limpia_variable($id_usuario);
			$usuario_sql = "SELECT
								*
							FROM
								estadisticas
							WHERE
								FK_id_usuarios = $this -> usuario";
			$usuario_res = $this->conexion->consultar($usuarios_sql);
		   
		   if(is_array($usuario_res)){
				return $usuario_res;
			}
			else{
				return false;
			}
		}
		
		function veces_juego_jugado ($id_videojuego){
			
		}
	}
?>
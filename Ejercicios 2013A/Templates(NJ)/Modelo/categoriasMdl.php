<?php
include_once 'Modelo/conexionMdl.php';

    class Categorias extends DB{
		private $nombre_categoria;
		
		function __construct(){
			require'conexion/bd_info.inc';
			parent::__construct($dbhost, $dbuser, $dbpass, $db);
			if(!$this -> conectar()){
				$mensaje = 'No se pudo conectar!';
				include_once 'Vista/mensajeView.php';
				exit;
			}
		}
		
		function insertar ($nombre,$imagen){
			$this -> nombre = $this->conexion->limpia_variable($nombre);
			$this -> imagen = $this->conexion->limpia_variable($imagen);
			
			$archivos = new ArchivoServidor();
			
			$directorio_categorias = "";
			$extensiones = array('image/jpeg', 'image/png', 'image/gif');
			
			$guardado = $archivo->subir($nombre, $directorio_categorias, $imagen, $extensiones);
			
			$insert_categorias_sql = "INSERT INTO
								 			categorias
								 			(categoria,
								 			imagen)
								 		VALUES
								 			('$this -> nombre',
								 	 		'$this -> imagen'
											'$nombre')";
			return $this->conexion->consultar($insert_categorias_sql);
			
		}
		
		function eliminar ($id_categoria){
			 if($this->obtener_categoria($id_categoria)!= 'error-categorias'){
			 	$delete_categoria_sql = "DELETE FROM
										categorias
									WHERE
										id_categoria = $this->id_categoria";
				return $this->conexion->consultar($delete_categoria_sql);
			 }
			 else{
			 	return 'error-categorias';
			 }
			 	
			 
		}
		
		function modificar ($nombre){
			 $categoria = $this->obtener_categoria($id_categoria);
			 $this-> nombre_categoria = $this->conexion->limpia_variable($nombre);
			
			if($categoria != 'error-categorias'){
				$update_nombre_categoria_sql = "UPDATE
													categoria
									 			SET
									 				categoria = '$this->nombre_categoria',
												 WHERE
													id_categoria = $this->id_categoria";
				return $this->conexion->consultar($update_nombre_categoria_sql);
			}
			else {
				return $categoria;
			}
		}
		
		function modificar_imagen ($id_categoria,$imagen){
			$categoria = $this->obtener_rango($id_categoria);
			if($categoria != 'error-categorias'){
				$archivos = new ArchivoServidor();
				$directorio_categorias = "";
				$extensiones = array('image/jpeg', 'image/png', 'image/gif');
				
				$guardado = $archivo->subir($directorio_categorias, $imagen, $extensiones);
				
				if($guardado != TRUE){
					return $guardado;
				}
					$update_categorias_sql = "UPDATE
								 				categorias
								 	 		SET
								 	 			imagen= '$nombre' 
								 	 		WHERE
								 	 			id_categorias = $this->id_categorias"; //duda en variable nombre
					return $this->conexion->consultar($update_categorias_sql);
			}
			else {
				return $rango;
			}
		}
		
		function obtener_categoria ($id_categoria){
			$this -> id_categoria = $categoria;
			$this -> categoria = $this -> conexion -> limpia_variable($id_categoria);
			$categorias_sql = "SELECT
									*
							 	FROM
							 	 	categorias
							    WHERE
							 	 	id_categoria = $this -> categoria";
			$categorias_res =  $this->conexion->consultar($categorias_sql);
			
			if(is_array($categorias_res)){
				return $categorias_res[0];
			}
			else{
				return 'error-categorias';
			}
		}
		
		function lista_categorias(){
			$categorias_sql = "SELECT
									*
							 	FROM
							 	 	categorias";
			$categorias_res = $this->conexion->consultar($categorias_sql);
			
			if(is_array($categorias_res)){
				return $categorias_res;
			}
			else{
				return 'error-categorias';
			}
		}
		
		//function lista_categorias_nombre($nombre) está demas!
    }
?>
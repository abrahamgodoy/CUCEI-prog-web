<?php
	include_once 'Modelo/conexionMdl.php';
	
	class Usuarios extends DB{
		
		public $id_usuario;
		public $usuario;
		public $password;
		public $email;
		public $avatar;
		public $fecha_registro;
		public $nacimiento;
		public $sexo;
		public $activo;
		public $privilegios;
		
		function __construct(){
			require'conexion/bd_info.inc';
			parent::__construct($dbhost, $dbuser, $dbpass, $db);
			if(!$this -> conectar()){
				$mensaje = 'No se pudo conectar!';
				include_once 'Vista/mensajeView.php';
				exit;
			}
		}
		
		
		function insertar($usuario, $pass, $email, $privilegios){
			$fecha_registro = date('Y-m-d');
			
			$insert_user_sql = "INSERT INTO
								 	usuarios
								 	(user,
								 	pass,
								 	email,
								 	fecha_registro,
								 	privilegios)
								 VALUES
								 	('$usuario',
								 	 '$pass',
								 	 '$email',
								 	 '$fecha_registro',
								 	 '$privilegios')";
									 
			$res = $this -> consultar($insert_user_sql);
			$insert_estadistica_sql="INSERT INTO
									 	estadisticas
									 	(FK_id_usuarios,
									 	FK_id_rango)
									 VALUES
									 	($res,
									 	 1)";
			$insert_estadistica_res = $this->consultar($insert_estadistica_sql);
			return $res;
		}

		function consulta_user_id($id){
			$usuario_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								id_usuarios = $id";
			$usuario_res = $this->consultar($usuario_sql);
			if(is_array($usuario_res)){
				return $usuario_res[0];
			}
			else{
				return false;
			}
		}
		
		function consulta_user($usuario){
			$usuario_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								user = '$usuario'";
			$usuario_res = $this->consultar($usuario_sql);
			if(is_array($usuario_res)){
				return $usuario_res[0];
			}
			else{
				return false;
			}
		}
		
		function consulta_user_email($email){
			$usuario_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								email = '$email'";
			$usuario_res = $this->consultar($usuario_sql);
			if(is_array($usuario_res)){
				return $usuario_res[0];
			}
			else{
				return false;
			}
		}
		
		function mostrar_usuarios(){
			$usuarios_sql = "SELECT
								*
							FROM
								usuarios";
			$usuarios_res = $this->consultar($usuario_sql);
			if(is_array($usuarios_res)){
				return $usuarios_res;
			}
			else{
				return false;
			}
		}
		
		function mostrar_usuarios_activos(){
			$usuarios_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								activo = 1";
			$usuarios_res = $this->consultar($usuario_sql);
			
			if(is_array($usuarios_res)){
				return $usuarios_res;
			}
			else{
				return false;
			}
		}
		
		function mostrar_usuarios_inactivos(){
			$usuarios_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								activo = 0";
			$usuarios_res = $this->consultar($usuario_sql);
			
			if(is_array($usuarios_res)){
				return $usuarios_res;
			}
			else{
				return false;
			}
		}
		
		function activa_usuario($id_usuario){
			$activa_sql = "UPDATE
								usuarios
							  SET
							  	activo = '1'
							  WHERE
							  	id_usuarios = $id_usuario";
			$activa_res = $this->consultar($usuario_sql);
			
			return $activa_res;
		}
		
		function desactiva_usuario($id_usuario){
			$desactiva_sql = "UPDATE
								usuarios
							  SET
							  	activo = '0'
							  WHERE
							  	id_usuarios = $id_usuario";
			$desactiva_res = $this->consultar($usuario_sql);
			
			return $desactiva_res;
		}
		
		function eliminar_usuario($id_usuario){
			$elimina_user_sql = "DELETE FROM
									usuarios
								  WHERE
								  	id_usuario = $id_usuario";
			$elimina_user_res = $this->conexion->consultar($elimina_user_sql);
			return $elimina_user_res;
		}
		
		function antiguedad($id_usuario){
			$usuario = $this->consulta_user_id($this -> id_usuario);
			
			$token = strtok($usuario['fecha_registro'], '-');
			$mes_user = $token[1];
			$anio_user = $token[2];
			
			$mes = date('m');
			$anio = date('Y');
			
			$meses = ($anio - $anio_user)*12;
			$meses += $meses-$mes_user;
			
			return $meses;
		}

		function actualiza_datos_personales($id_usuario, $pass, $email, $nacimiento, $sexo){
			$this ->id_usuario = $this ->conexion ->limpia_variable($id_usuario);
			$this ->password = md5($this ->conexion ->limpia_variable($pass));
			$this ->email = $this ->conexion ->limpia_variable($email);
			$this ->nacimiento = $this ->conexion ->limpia_variable($nacimiento);
			$this ->sexo = $this ->conexion ->limpia_variable($sexo);
			
			$usuario_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								id_usuario = $this->id_usuario
							AND
								pass = '$this->password'";
			$usuario_res = $this -> conexion -> consultar($usuario_sql);
			
			if(is_array($usuario_res)){
				$usuario_res = $usuario_res[0];
				
				$update_user_sql = "UPDATE
										usuarios
									SET
										email = '$this->email',
										nacimiento = '$this->nacimiento',
										sexo = '$this->sexo'
									WHERE
										id_usuario = '$this->id_usuario'";
				return $this ->conexion ->consultar($update_user_sql);
			}
			else{
				return 'error-usuario';
			}
		}
		
		function actualiza_avatar($id_usuario, $pass, $avatar){
			$this ->id_usuario = $this ->conexion ->limpia_variable($id_usuario);
			$this ->password = md5($this ->conexion ->limpia_variable($pass));
			$this ->avatar = $avatar;
			
			$usuario_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								id_usuario = $this->id_usuario
							AND
								pass = '$this->password'";
			$usuario_res = $this -> conexion -> consultar($usuario_sql);
			
			if(is_array($usuario_res)){
				$usuario_res = $usuario_res[0];
				$archivos = new ArchivoServidor();
				$directorio_avatares = "";
				$extensiones = array('image/jpeg', 'image/png', 'image/gif');
				$tamanoMaximo = 1572864;
				$nombre = $usuario_res['user'];
				
				$guardado = $archivos -> subir($nombre, $directorio, $this ->avatar, $extensiones, $tamanoMaximo);
				
				if($guardado != TRUE){
					return $guardado;
				}
				
				$update_user_sql = "UPDATE
										usuarios
									SET
										avatar = '$nombre'
									WHERE
										id_usuario = '$this->id_usuario'";
				return $this ->conexion ->consultar($update_user_sql);
			}
			else{
				return 'error-usuario';
			}
		}
		
		function actualiza_password($id_usuario, $pass, $pass1, $pass2){
			$this ->id_usuario = $this ->conexion ->limpia_variable($id_usuario);
			$this ->password = md5($this ->conexion ->limpia_variable($pass));
			
			$usuario_sql = "SELECT
								*
							FROM
								usuarios
							WHERE
								id_usuario = $this->id_usuario
							AND
								pass = '$this->password'";
			$usuario_res = $this -> conexion -> consultar($usuario_sql);
			
			if(is_array($usuario_res)){
				if(strcmp($pass1, $pass2) != 0){
					return 'error-pass-coincidencia';
				}
				else{
					if(strlen($pass1) < 6 || strlen($pass1) > 10){
						return 'error-pass-long';
					}
						$this -> password = md5($pass1);
				}
				
				$update_user_sql = "UPDATE
										usuarios
									SET
										pass = '$this->password'
									WHERE
										id_usuario = '$this->id_usuario'";
				return $this ->conexion ->consultar($update_user_sql);
			}
			else{
				return 'error-usuario';
			}
		}
		
	}	
?>
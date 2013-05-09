<?php
include_once 'Modelo/conexionMdl.php';
include_once 'Modelo/usuariosMdl.php';

	class Sesion extends DB{
		
		public $usuario;
		
		function __construct(){
			require 'conexion/bd_info.inc';
			parent::__construct($dbhost, $dbuser, $dbpass, $db);
			if(!$this -> conectar()){
				$mensaje = 'No se pudo conectar!';
				include_once 'Vista/mensajeView.php';
				exit;
			}
			$this->usuario = new Usuarios();
		}
		
		function login($usuario, $password){
			$usuario_sql = "SELECT
									*
								FROM
									usuarios
								WHERE
									user = '$usuario'
								AND
									pass = '$password'
								AND
									activo = '1'";
			$res = $this->consultar($usuario_sql);
			if(is_array($res[0])){
				$res = $res[0];
				$this->usuario->id_usuario = $res['id_usuarios'];
				$this->usuario->usuario = $res['user'];
				$this->usuario->email = $res['email'];
				$this->usuario->avatar = $res['avatar'];
				$this->usuario->fecha_registro = $res['fecha_registro'];
				$this->usuario->nacimiento = $res['nacimiento'];
				$this->usuario->sexo = $res['sexo'];
				$this->usuario->privilegios = $res['privilegios'];
				$this->usuario->activo = $res['activo'];
				return true;
			}
			
			return false;
		}
		
		function perfilpropio($usuario){
			session_start();
			if(isset($_SESSION['user']) && $_SESSION['user'] == $usuario){
				return true;
			}
			
			return false;
		}
	}
?>

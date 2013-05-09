<?php

/**
 * @subpackage controlador
 * 
 */
 
include_once 'Modelo/usuariosMdl.php';

class RegistroCtrl{
	public $modelo;
	
	function __construct(){
		$this->modelo = new Usuarios();
	}

	function registrar(){
		switch ($_REQUEST['registro']) {
			case 'inserta':
				$this->insertar();
				break;
			
			default:
				include_once 'Vista/usuarios/registroView.php'; //carga vista para el formulario
				break;
		}
	}
	
	private function insertar(){
		$error = FALSE;
		$mensaje = '';
		//Comprobación del nombre de usuario
		
		if(isset($_REQUEST['user']) && $_REQUEST['user'] != ''){
			$usuario = $this->modelo->limpia_variable($_REQUEST['user']);
			$usuario = strtolower($usuario);
			$en_uso = $this->modelo->consulta_user($usuario);
			$match_user = '/^[a-z]+([_a-z0-9-]+)*$/';
			
			if(strlen($usuario) < 4 || strlen($usuario) > 12){
				$mensaje .= 'La longitud del usuario debe ser mayor igual 
				a 4 caracteres y menor igual a 12 caracteres\n';
				$error = TRUE;
			}
			elseif(preg_match($match_user, $usuario) == 0){
				$mensaje .= 'Nombre de usuario invalido\n';
				$error = TRUE;
			}
			
			elseif(is_array($en_uso)){
				$mensaje .= 'El nombre de usuario ya existe\n';
				$error = TRUE;
			}
		}
		else{
			$mensaje .= 'especifique un usuario\n';
			$error = TRUE;
		}
		
		//Comprobación de las contraseñas
		$hayPass1 = FALSE;
		$hayPass2 = FALSE;
		
		if(isset($_REQUEST['pass1']) && $_REQUEST['pass1'] != ''){
			$pass1 = $this->modelo->limpia_variable($_REQUEST['pass1']);
			$hayPass1 = TRUE;
		}
		else{
			$mensaje .= 'especifique el primer password\n';
			$error = TRUE;
		}
		
		if(isset($_REQUEST['pass2']) && $_REQUEST['pass2'] != ''){
			$pass2 = $this->modelo->limpia_variable($_REQUEST['pass2']);
			$hayPass2= TRUE;
		}
		else{
			$mensaje .= 'especifique el segundo password\n';
			$error = TRUE;
		}
		
		if($hayPass1 && $hayPass2){
			if(strcmp($pass1, $pass2) != 0){
				$mensaje .= 'Passwords no coinciden\n';
				$error = TRUE;
			}
			elseif(strlen($pass1) < 6 || strlen($pass1) > 12){
				$mensaje .= 'La longitud del password debe ser mayor igual 
				a 6 caracteres y menor igual a 12 caracteres\n';
				$error = TRUE;
			}
			
			if(!$error){
				$pass1 = md5($pass1);
				$pass2 = md5($pass2);
			}
		}
		//Comprobación de Email
		
		if(isset($_REQUEST['email']) && $_REQUEST['email'] != ''){
			$email = $this->modelo->limpia_variable($_REQUEST['email']);
			$en_uso = $this->modelo->consulta_user($email);
			
			$match_email = '/^[_a-z0-9]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
			if(preg_match($match_email, $email) == 0){
				$mensaje .= 'Correo no valido\n';
				$error = TRUE;
			}
			
			elseif($en_uso != FALSE){
				$mensaje .= 'El correo ya esta en uso\n';
				$error = TRUE;
			}
		}
		else{
			$mensaje .= 'especifique un email\n';
			$error = TRUE;
		}
		
		//Establecimiento de Priveligios de usuario común
		
		$privilegios = 0;
		if($error){
			include_once 'Vista/mensajeView.php';
			return FALSE;
		}
		
		$usuario = $this->modelo->insertar($usuario, $pass1, $email, $privilegios);
		if(is_string($usuario)){
			$mensaje = $this->error($usuario);
			include_once 'Vista/mensajeView.php';
		}
		else{
			$mensaje = 'Registro confirmado, espere un correo de confirmacion';
			include_once 'Vista/mensajeView.php';
		}	
	}  // Compiar funcion registrar para administradores y superadministradores cambiando numero

}	

?>

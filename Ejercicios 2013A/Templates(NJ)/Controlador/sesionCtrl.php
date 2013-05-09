<?php

	/**
	 * @subpackage controlador
	 * 
	 */
	include_once 'Modelo/sesionMdl.php';
	
	class SesionCtrl{
		public $modelo;
		public $modelo_user;
		
		function __construct(){
			$this->modelo = new Sesion();
		}
	
		function sesion(){
			switch ($_REQUEST['login']) {
				case 'iniciar':
					$this->iniciar_sesion();
					break;
				case 'cerrar':
					$this->cerrar_sesion();			
					break;
				default:
					include_once 'Vista/usuarios/loginView.php';
					break;
			}
		}
		
		private function iniciar_sesion(){
			if($this->login()){
				$mensaje = 'Usted ya tiene sesion';
				include_once 'Vista/mensajeView.php';
			}
			else if(isset($_REQUEST['user']) && $_REQUEST['user'] != ''
				&& isset($_REQUEST['pass']) && $_REQUEST['pass'] != ''){
					
				$usuario = $this->modelo->limpia_variable($_REQUEST['user']);
				$password = md5($this->modelo->limpia_variable($_REQUEST['pass']));
				
				$sesion = $this->modelo->login($usuario, $password);
				if($sesion){
					$_SESSION['id_user'] = $this->modelo->usuario->id_usuario;
					$_SESSION['user']=  $this->modelo->usuario->usuario;
					$_SESSION['privilegios']=$this->modelo->usuario->privilegios;
					header('Location: index.php?usuario='.$_SESSION['user']);
				}
				else{
					$mensaje = 'Error al iniciar sesion';
					include_once 'Vista/mensajeView.php';
				}
			}
			else{
				$mensaje = 'Especifique su nombre y password';
				include_once 'Vista/loginForm.html';
			}	
		}
		
		private function cerrar_sesion(){
			if($this->login()){
				unset($_SESSION['id_user']);
				unset($_SESSION['user']);
				unset($_SESSION['privilegios']);
				session_destroy();
				setcookie(session_name(),'',time()-3600);
				header('Location: index.php');
			}
			else{ 
				header('Location: index.php');
			}
		}
		
		private function login(){
			session_start();
			
			if(isset($_SESSION['user']) && $_SESSION['user'] != ''){
				return TRUE;
			}
			return FALSE;
		}
	}
?>

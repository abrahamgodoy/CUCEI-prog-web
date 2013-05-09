<?php

/**
 * @subpackage controlador
 * 
 */
 
include_once 'Modelo/usuariosMdl.php';
include_once 'Modelo/videojuegoMdl.php';
include_once 'Modelo/estadisticasMdl.php';

class AdminCtrl{
	public $modeloUsuario;
	public $modeloVideojuego;
	public $modeloEstadistica;
	
	function __construct(){
		$this -> modeloUsuario = new Usuarios();
		$this -> modeloVideojuego = new Videojuegos();
		$this -> modeloEstadistica = new Estadisticas();
	}

	function ejecutar(){
		session_start();
		if(isset($_SESSION['privilegios'])){
			if($_SESSION['privilegios'] == 1 || $_SESSION['privilegios'] == 2){
				switch ($_REQUEST['admin']){
					case 'alta':
						$this->altaUser();
						break;
					case 'baja':
						$this->altaUser();
						break;
					case 'elimina':
						$res = $this->eliminaUser();
						
						if($res){
							$mensaje = 'Usuario eliminado correctamente';
							include_once 'Vista/mensajeView.php';
						}
						break;
					default:
						$admin = $_SESSION['user'];
						if($_SESSION['privilegios']== 1){
							$cargo = 'Administrador';
						}
						else{
							$cargo = 'Super Administrador';
						}
						include_once 'Vista/admin/homeView.php';
						break;
				}
			}
		}
		else{
			$mensaje = "Usted no tiene los privilegios para entrar a esta seccion";
			include_once 'Vista/mensajeView.php';
		}
	}
	
	function altaUser(){
		if(!isset($_REQUEST['id_user'])){
			$mensaje = 'Usuario no definido';
			include_once 'Vista/mensajeView.php';
		}
		$id_user = $this->modeloUsuario->limpia_variable($_REQUEST['id_user']);
		
		$usuario = $this->modeloUsuario->consulta_user_id($id_user);
		
		if(is_array($usuario)){
			$estado = $this->modeloUsuario->activa_usuario($id_usuario);
			if($estado){
				$mensaje = 'Usuario activado correctamente';
				include_once 'Vista/mensajeView.php';
			}
			else{
				$mensaje = 'Error al activar el usuario';
				include_once 'Vista/mensajeView.php';
			}
			
		}
		else{
			$mensaje = 'El usuario no existe';
			include_once 'Vista/mensajeView.php';
		}
	}
	
	function bajaUser(){
		if(!isset($_REQUEST['id_user'])){
			$mensaje = 'Usuario no definido';
			include_once 'Vista/mensajeView.php';
		}
		$id_user = $this->modeloUsuario->limpia_variable($_REQUEST['id_user']);
	
		$usuario = $this->modeloUsuario->consulta_user_id($id_user);
		
		if(is_array($usuario)){
			$estado = $this->modeloUsuario->activa_usuario($id_usuario);
			if($estado){
				$mensaje = 'Usuario desactivado correctamente';
				include_once 'Vista/mensajeView.php';
			}
			else{
				$mensaje = 'Error al desactivar el usuario';
				include_once 'Vista/mensajeView.php';
			}
		}
		else{
			$mensaje = 'El usuario no existe';
			include_once 'Vista/mensajeView.php';
		}
	}
	
	function eliminaUser(){
		if($_SESSION['privilegios'] == 2){
			if(!isset($_REQUEST['id_user'])){
				$mensaje = 'Usuario no definido';
				include_once 'Vista/mensajeView.php';
			}

			$id_user = $this->modeloUsuario->limpia_variable($_REQUEST['id_user']);
			$estadistica = $this->modeloEstadistica->consulta_estadistica_user($id_usuario);
			$listaJuegos = $this->modeloVideojuego->lista_videojuegos_usuario($id_usuario);
			$historiales = $this->modeloVideojuego->obten_historial_estadistica($estadistica['id_estadisticas']);
			
			if(is_array($listaJuegos)){
				foreach ($listaJuegos as $juego) {
					$this->modeloVideojuego->eliminar_videojuego($juego['id_videojuegos']);
				}
			}
			$this->modeloEstadistica->elimina_estadistica($estadistica['id_estadisticas']);
			$this->modeloVideojuego->elimina_historial_estadistica($estadistica['id_estadisticas']);
			
			$this->modeloUsuario->eliminar_usuario($id_user);
			return TRUE;
		}
		else{
			$mensaje = "Usted no tiene los privilegios para entrar a esta seccion";
			include_once 'Vista/mensajeView.php';
			return FALSE;
		}
	}
}
?>
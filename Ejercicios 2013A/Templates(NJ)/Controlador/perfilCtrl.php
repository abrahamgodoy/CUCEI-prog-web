<?php

/**
 * @subpackage controlador
 * 
 */
 
include_once 'Modelo/usuariosMdl.php';

class PerfilCtrl{
	public $modelo;
	
	function __construct(){
		$this -> modelo = new Usuarios();
	}

	function perfil(){
		$dirAvatar = '';
		$dirRango = '';
		if($_REQUEST['usuario'] != ''){
			$usuario = $this -> modelo -> limpia_variable($_REQUEST['usuario']);
			$usuario = $this -> modelo -> consulta_user($usuario);
			
			if($usuario != FALSE){
				include_once 'Modelo/sesionMdl.php';
				$perfilpropio = new Sesion();
				
				if($perfilpropio->perfilpropio($usuario['user'])){
					$configuracion = true;
				}
				else {
					$configuracion = false;
				}

				$user = $usuario ['user'];
				$avatar = $dirAvatar.$usuario['avatar'];
				$sexo = $usuario['sexo'];
				$fecha_registro = $usuario['fecha_registro'];
				$rangoUsuario = $this -> rango($usuario ['fecha_registro']);
				$rango_img = $dirRango.$rangoUsuario['imagen'];
				
				include_once 'Modelo/videojuegoMdl.php';
				$videojuegos = new Videojuegos();
				$listaJuegos = $videojuegos->lista_videojuegos_usuario($usuario['id_usuarios']);
				
				include_once 'Vista/usuarios/perfilView.php';
			}
			else{
				$mensaje = 'El usuario no existe';
				include_once 'Vista/mensajeView.php';
			}
		}
		else {
			$mensaje = 'No se especificó usuario';
			include_once 'Vista/mensajeView.php';
		}
	}
	
	function rango($fecha_registro){
		include_once 'Modelo/rangoMdl.php';
		$fecha_actual = date('Y-m-d');
		$fecha_actual = explode('-',$fecha_actual);
		$año = $fecha_actual[0];
		$mes = $fecha_actual[1];
		
		$fecha_registro = explode('-',$fecha_registro );
		$añoRegistro = $fecha_registro [0];
		$mesRegistro = $fecha_registro [1];
		
		$añoDif = ($año - $añoRegistro) * 12;
		$mesDif = $mes - $mesRegistro;
		
		$resultado = $añoDif + $mesDif;
		
		$rangoAntiguedad = new Rango();
		
		$rango = $rangoAntiguedad->obtener_rango_antiguedad($resultado);
		
		return $rango;
	}
	
	
}	

?>
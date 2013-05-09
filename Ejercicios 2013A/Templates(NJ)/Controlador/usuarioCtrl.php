<?php

/**
 * @subpackage controlador
 * 
 */
 
include_once 'Modelo/usuariosMdl.php';

class UsuarioCtrl{
	public $modelo;
	
	function __construct(){
		$this -> $modelo = new Usuarios();
	}
	
	private function error($error){
		switch ($error) {
			case 'error-pass-coincidencia':
				$mensaje = 'Los passwords no coinciden';
				break;
			case 'error-pass-long':
				$mensaje = 'El password debe medir entre 6 a 10 caracteres';
				break;
			case 'error-user':
				$mensaje = 'El usuario ya existe';
				break;
			case 'error-connect':
				$mensaje = 'Error al insertar el usuario';
				break;
			case 'error-query':
				$mensaje = 'Error al realizar la consulta';
				break;
			default:
				$mensaje = '';
				break;
		}
		return $mensaje;
	}
}

?>
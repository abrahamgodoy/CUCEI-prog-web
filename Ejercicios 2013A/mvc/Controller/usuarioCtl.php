<?php

/**
 * @package mvc
 * @subpackage controller
 * @author
 */

//Este controlador require tener acceso al modelo
include_once('Model/usuarioBss.php');

//La clase controlador

class usuarioCtl{

	public $modelo;

	//Cuando se crea el controlador crea el modelo de usuario
	function __construct(){
		$this -> modelo = new usuarioBss();
	}

	function ejecutar(){
		//Si no tengo parametros, listo los usuarios
		if( !isset($_REQUEST['action']) ){
			//Obtengo los datos que se van a listar
			$usuarios = $this->modelo->listar();
			
			//Muestro los datos
			include('View/usuarioListaView.php');
		}
		else switch($_REQUEST['action']){
			case 'insertar':
				$usuario = $this->modelo->insertar($_REQUEST['nombre'],$_REQUEST['mail'],$_REQUEST['pass'],$_REQUEST['privilegio']);
				if ( is_array($usuario) )
					include('View/usuarioInsertadoView.php');
				else
					include('View/usuarioError.php');
				break;
		}				
		
		
	}
}

?>

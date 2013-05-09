<?php

	/**
	 *@var $controlador: inicializa el controlador
	 * 
	 */
	//Incluimos el controlador
	
	
	//Instancia del controlador
	
	if(isset($_REQUEST['usuario'])){
		include_once 'Controlador/perfilCtrl.php';
		$perfilCtrl = new PerfilCtrl();
		$perfilCtrl->perfil();
	}
	else if(isset($_REQUEST['login'])){
		include_once 'Controlador/sesionCtrl.php';
		$sesionCtrl = new SesionCtrl();
		$sesionCtrl->sesion();
	}
	else if(isset($_REQUEST['registro'])){
		include_once 'Controlador/registroCtrl.php';
		$registroctrl = new RegistroCtrl();
		$registroctrl->registrar();
	}
	else if(isset($_REQUEST['game'])){
		include_once 'Controlador/videojuegosCtrl.php';
		$gameCtrl = new VideojuegoCtrl();
		$gameCtrl->ejecutar();
	}
	else if(isset($_REQUEST['admin'])){
		include_once 'Controlador/adminCtrl.php';
		$adminCtrl = new AdminCtrl();
		$adminCtrl->ejecutar();
	}
	else if(isset($_REQUEST['info'])){
		phpinfo();
	}
	else{
		
		include_once 'Controlador/StdCtrl.php';
		
		$stdCtrl = new StdCtrl();
		$stdCtrl -> ejecutar();
	}
		
?>

<?php

	//Cargamos o creamos una sesion
	session_start();

	if( isset($_SESSION['id_user']) ){
		//Ya existe la sesion y no debe intentar hacer login
	}
	//Valido que exista la combinación de usuario y password y los agrego a la sesión
	if ( MDL->validaUsuario($_POST['user'],$_POST['pass']) ){
		$_SESSION['id_user']	= MDL->Usuario->id;
		$_SESSION['privilegio'] = MDL->Usuario->privilegio;
	}

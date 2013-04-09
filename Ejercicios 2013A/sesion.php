<?php

	session_start();

	if( isset($_SESSION['id_user']) ){
		//Ya existe la sesion
	}
	if ( MDL->validaUsuario($_POST['user'],$_POST['pass']){
		$_SESSION['id_user']	= MDL->Usuario->id;
		$_SESSION['privilegio'] = MDL->Usuario->privilegio;
	}

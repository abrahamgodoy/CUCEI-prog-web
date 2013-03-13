<?php

//la cadena en la url
//tuhost.com/index.php?controlador=producto&accion=insertar&nombre=jabon&descripcion=algo%20raro&precio=15&costo=30

//Validar lo que el usuario quiere
switch($_REQUEST['controlador']){
	case 'producto':
		//Cargo la información del controlador
		include('controlador/productoCtl.php');
	
		//Creo el objeto controlador y lo ejecuto	
		$controlador = new productoCtl();
		break;
	case 'usuario':	
		//Cargo la información del controlador
		include('controlador/usuarioCtl.php');
	
		//Creo el objeto controlador y lo ejecuto	
		$controlador = new usuarioCtl();
		break;		 
}

$controlador -> ejecutar();
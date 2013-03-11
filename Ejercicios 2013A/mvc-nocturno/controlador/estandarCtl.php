<?php

class estandarCtl{
	public $modelo;

	function __construct(){
		//Incluir el modelo
		include('modelo/productoBss.php');

		//Creo el objeto del modelo
		$this->modelo =  new productoBss();
	}

	function ejecutar(){
		//Si no hay una accion definida en las variables,
		//entonces listo los productos
		if ( !isset($_REQUEST['accion']) ) {
			$productos_array = $this->modelo->listar();

			if ( is_array($productos_array) ){
				//Incluir la vista para listar
				include('vista/productoListaView.php');
			}
			else{
				//Mando a llamar la vista de errores
				die('No hay datos');
			}
		}
	}

}

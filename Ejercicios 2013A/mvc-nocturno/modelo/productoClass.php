<?php

class Producto{

	public $id;
	public $nombre;
	public $descripcion;
	public $precio;
	public $costo;

	/**
	 * @param
	 */
	function __construct($id, $nombre, $desc, $precio, $costo){
		$this -> id 	= $id;
		$this -> nombre	= $nombre;
		$this -> descripcion = $desc;
		$this -> precio = $precio;
		$this -> costo = $costo;
	}
}

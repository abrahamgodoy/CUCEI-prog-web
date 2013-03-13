<?php	

class productoBss{

	/**
	 * @return mixed, array $productos, en caso de falla FALSE
	 */
	function listar(){
		//Cargo los datos para la conexión
		include('db_data.inc');
		include('databaseClass.php');
		$conexion = new DB($hostdb, $userdb, $passdb, $db);
		
		//Creo mi conexión
		$status = $conexion->conectar();
		//En caso de que devuelva una falla
		if($status === FALSE){
			die('No se pudo conectar');
		}
		
		//Creo mi query
		$consulta = "SELECT
						*
					 FROM
						producto";

		//Ejecuto la consulta
		$resultado = $conexion -> ejecutarConsulta($consulta);

		//Si fue una falla
		if($conexion === FALSE){
			$conexion -> cerrar();	
			return FALSE;
		}

		//Cierro la conexion
		$conexion -> cerrar();

		//Proceso el arreglo para convertirlo
		//en una colección de objetos de tipo
		//producto.
		require('productoClass.php');

		//Por cada producto
		foreach($resultado as $prod){
			$producto = new Producto($prod['idproducto'], $prod['nombre'], $prod['descripcion'], $prod['precio'], $prod['costo']);
			$lista_productos[] = $producto;
		}
		
		//Regreso los productos
		return $lista_productos;
	}
}

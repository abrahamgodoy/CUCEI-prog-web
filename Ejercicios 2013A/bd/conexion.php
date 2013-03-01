<?php

/**
 * @package Ejercicios2013A
 * @subpackage BD
 * @author Michelle Torres <lic.nancy.torres@gmail.com>
 * @version 1.0
 */

class miConexion{

	/**
	 * @return boolean true for success
	 */
	function conectar(){

		require_once('bd_info.inc');

		@$mysqli = new mysqli($host, $user, $pass, $bd);
		if ( isset($mysqli -> connect_errno) && !empty($mysqli -> connect_errno) )
			echo 'NO SE CONECTO PORQUE: '.$mysqli -> connect_error;
		else{
			//var_dump($mysqli);
			$miQuery = 'SELECT
							*
						FROM
							usuario';
			$resultado = $mysqli -> query($miQuery);
			var_dump($resultado);

			//cierro la conexion
			$mysqli -> close();

			//No funciona porque necesitas mysqlnd instalado
			//$resultadoArray = $resultado -> fetch_all(MYSQL_ASSOC);

			while($fila = $resultado -> fetch_assoc())
				var_dump($fila);
			
		}
	}
}

$mc = new miConexion();
$mc -> conectar();





<?php
/**
 * @package Ejercicios2013A
 * @license @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Michelle Torres <lic.nancy.torres@gmail.com>
 * @version 1.0
 */
 
function tablas(){
	for($tabla = 1 ; $tabla <= 12 ; $tabla++ ){
 		for($mul = 1 ; $mul <= 12 ; $mul++ ){
			echo $tabla . 'X' . $mul . '=' . $tabla*$mul . PHP_EOL;
 		}
		echo PHP_EOL;
 	}
}

tablas();

?>

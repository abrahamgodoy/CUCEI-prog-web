<?php

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

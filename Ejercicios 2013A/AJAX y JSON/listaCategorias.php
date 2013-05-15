<?php
	$categorias = array(
							array( 'id' => 1,
									 'nombre' => 'Carnes'),
							array( 'id' => 2,
									 'nombre' => 'Lacteos')
					 );

	//Generar el json					 
	echo json_encode($categorias);
?>

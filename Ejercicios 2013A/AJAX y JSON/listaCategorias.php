<?php
	$categorias = array(
							array( 'id' => 1,
									 'nombre' => 'cat1'),
							array( 'id' => 2,
									 'nombre' => 'cat2')
					 );

	//Generar el json					 
	echo json_encode($categorias);
?>
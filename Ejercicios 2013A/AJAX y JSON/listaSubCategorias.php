<?php
	if(isset($_GET['id'])){
		$categorias = array(
								array( 'id' => 1,
										 'nombre' => 'sub1'),
								array( 'id' => 2,
										 'nombre' => 'sub2')
						 );

		//Generar el json					 
		echo json_encode($categorias);		
	}

	else
		echo 'falla';

?>

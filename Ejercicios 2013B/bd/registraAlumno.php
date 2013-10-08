<?php
	//Creando mi conexion
	$con = new mysqli('localhost','cc409_user214','46PpMnaapa','cc409_user214');


	if($con->connect_error){
		//echo "no me puedo conectar";
		//exit();
		die('No me pude conectar');
	}
	
	$nombre 	= $_POST["nombre"];
	$codigo 	= $_POST["codigo"];
	$pass 		= $_POST["pass"];
	$carrera 	= $_POST["ingenierias"];
	$mail 		= $_POST["mail"];

	$miquery = "INSERT INTO alumno
							(codigo, nombre, carrera, correo)
							VALUES 
							(\"$codigo\", \"$nombre\", \"$carrera\", \"$mail\")";

	$resultado = $con->query($miquery);

	var_dump($resultado);
	var_dump($con->insert_id);

	$con->close();


?>

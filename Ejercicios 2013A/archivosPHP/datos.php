<?php

$datos = array(
				array('nombre' => 'juan',
						'edad' => 15,
						'id' => 1				
				),
				array('nombre' => 'maria',
						'edad' => 18,
						'id' => 2				
				),
				array('nombre' => 'pedro',
						'edad' => 16,
						'id' => 3				
				),
				array('nombre' => 'pablo',
						'edad' => 17,
						'id' => 4				
				)
			);
			
$cadena = json_encode($datos);
$ruta = 'prueba_json.inc';

//if ( file_put_contents($ruta, $cadena) != FALSE)
//	echo 'Se escribio al archivo';

if ( file_exists($ruta) ){
	echo 'El archivo ya existe elige otra ruta';
	if ( unlink($ruta) )
		echo 'Te hice el paro y lo borre';
}
else{
	$archivo = fopen($ruta, 'w');
	if ( fwrite($archivo, $cadena) != FALSE)
		echo 'Se ha escrito en el archivo';
	else
		echo 'Hubo un error al intentar escribir';
}

chmod
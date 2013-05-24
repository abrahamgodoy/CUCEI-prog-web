<?php

echo '<br>Dirname: '; var_dump(dirname('archivos.php'));
echo '<br>Pathinfo: '; var_dump(pathinfo('archivos.php'));
echo '<br>Realpath: '; var_dump(realpath('archivos.php'));

//Creamos el directorio hola
$ruta = './hola';
if (! is_dir($ruta) ){
	if ( mkdir($ruta) )
		echo 'Se creo el directorio '.$ruta;
	else 
		echo 'Hubo un error con el comando mkdir al crear '.$ruta;
}
else {
	echo 'El directorio '.$ruta.'ya existe';
}


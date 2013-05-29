<?php

$para = 'al_xsnake@hotmail.com';
$asunto = 'probando mail';
$mensaje = 'Esta es una prueba desde un servidor local';
$headers = 'From: direccion@cucei.udg.mx'

if ( mail($para,$asunto,$mensaje,$headers) ){
	echo 'Se mando el correo';
}
else {
	echo 'Hubo algun error';
}
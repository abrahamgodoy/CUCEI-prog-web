<?php

/**
 * @package mvc
 */

//Necesitamos utilizar el controlador
include('Controller/StdCtl.php');

//Creamos el contralador estándar y lo mandamos a ejecutar
$controlador = new StdCtl();
$controlador -> ejecutar();

?>

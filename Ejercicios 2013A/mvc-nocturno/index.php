<?php

//Cargo la información del controlador

include('controlador/estandarCtl.php');

//Creo el objeto controlador y lo ejecuto
$controlador = new estandarCtl();
$controlador -> ejecutar();

<?php

		$filename = "conCadena.xls";
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-type: application/ms-excel");
    header("Content-Disposition: attachment; filename=$filename "); 
    
    $cadena = "a \t b \t c \t d \t\ne \t f \t g \t h\t\n";
    
    echo $cadena; 
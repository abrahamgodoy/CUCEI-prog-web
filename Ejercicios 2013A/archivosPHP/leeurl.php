<h1>Este lee una url y lo muestra</h1>

<?php

$url = 'http://ejercicioscc419/archivosPHP/prueba_json.inc';

$contenido = file_get_contents($url);

echo '<pre>'; var_dump($contenido); echo '</pre>';

?>
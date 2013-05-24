<h1>Este lee un archivo y lo muestra</h1>

<?php

$ruta = 'prueba_json.inc';

$contenido = file_get_contents($ruta);

$contenido = json_decode($contenido);

echo '<pre>'; var_dump($contenido); echo '</pre>';

?>
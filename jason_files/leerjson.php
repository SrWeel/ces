<?php
$table='app_cliente';
$contenido = file_get_contents("estructura/".$table.".json");

$products = json_decode($contenido, true);

print_r($products);


?>
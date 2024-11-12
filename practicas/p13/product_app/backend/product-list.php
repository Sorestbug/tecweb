<?php
use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');  // Asegura que la respuesta sea tratada como JSON

$productos = new Products('marketzone');
$productos->list();  // Este método debe llenar la propiedad interna de la clase 'data' con los productos
echo $productos->getData();  // Devuelve los productos en formato JSON
?>

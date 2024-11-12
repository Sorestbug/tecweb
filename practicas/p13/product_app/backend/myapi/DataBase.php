<?php
namespace TECWEB\MYAPI;

abstract class DataBase {
    protected $conexion;

    public function __construct($db, $user = 'root', $pass = '12345678a') {
        $this->conexion = @mysqli_connect('localhost', $user, $pass, $db);
    
        if (!$this->conexion) {
            die('¡Base de datos NO conectada!');
        }
    }
}
?>

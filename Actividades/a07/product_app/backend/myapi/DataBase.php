<?php
namespace App;

use \PDO;
use \PDOException;
use \Exception;

abstract class DataBase {
    protected PDO $conexion;

    public function __construct(string $user = 'root', string $pass = '12345678a', string $db = 'marketzone') {
        try {
            $this->conexion = new PDO("mysql:host=localhost;dbname=$db;charset=utf8", $user, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("¡Base de datos NO conectada!: " . $e->getMessage());
        }
    }
}
?>

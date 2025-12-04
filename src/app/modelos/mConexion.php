<?php
require_once 'app/config/configDB.php';

class Conexion
{

    protected $conexion;

    public function __construct()
    {

        try {
            $this->conexion = new PDO(
                "mysql:host=" . servidor .
                ";dbname=" . nombreDB . ";charset=UTF8",
                usuario,
                password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->conexion = null;
    }
}
?>
<?php
require_once 'src/app/modelos/mConexion.php';

try {
    $conexion = new Conexion();
    echo "Conexión exitosa!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

<?php
require_once 'mConexion.php';

class Alumno extends Conexion
{

    /* public function registraAlumno($email, $password)
    {
        // IMPORTANTE: Por seguridad, deberías encriptar la contraseña.
        // Si decides hacerlo, descomenta la siguiente línea y úsala en el execute:
        // $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "
                INSERT INTO usuarios (mail, contraseña) 
                VALUES (?, ?);
            ";

        $stmt = $this->conexion->prepare($sql);
        
        // Ejecutamos la consulta. Devuelve true si funcionó, false si falló.
        // (Si usas hash, cambia $password por $passwordHash aquí)
        $exito = $stmt->execute([$email, $password]);

        if ($exito) {
            // Retorna el ID del usuario recién creado
            return $this->conexion->lastInsertId();
        } else {
            // Retorna false o null si hubo un error
            return null;
        }
    }  */  

    public function crearTurno($nombre)
    {
   
        $sql = "
            INSERT INTO alumnos_turnos (nombre) 
            VALUES (?)";

        $stmt = $this->conexion->prepare($sql);
        $exito = $stmt->execute([$nombre]);

        if ($exito) {
            return $this->conexion->lastInsertId(); 
        } else {
            return false;
        }
    }

    public function obtenerSiguientes()
    {
        // Seleccionamos los que están en 'espera'
        // ORDER BY id ASC asegura que salgan en el orden que llegaron
        // LIMIT 10 asegura que solo traigas los próximos 5
        $sql = "
                SELECT * FROM alumnos_turnos 
                WHERE estado = 'espera' 
                ORDER BY id ASC 
                LIMIT 5
            ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        // Usamos fetchAll para obtener UNA LISTA de resultados, no solo uno.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
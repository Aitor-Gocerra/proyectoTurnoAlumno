<?php
    require_once 'mConexion.php';

    class Alumno extends Conexion{

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
            // LIMIT 5 asegura que solo traigas los próximos 5
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

        public function obtenerTurnoActual()
        {
            // Seleccionamos el turno que está siendo atendido actualmente
            $sql = "
                    SELECT * FROM alumnos_turnos 
                    WHERE estado = 'atendido' 
                    ORDER BY id ASC 
                    LIMIT 1
                ";

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();

            // Usamos fetch para obtener UN SOLO resultado
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function avanzarTurno()
        {
            // 1. Finalizar el que estaba siendo atendido
            $sqlCerrar = "UPDATE alumnos_turnos SET estado = 'finalizado' WHERE estado = 'atendido'";
            $this->conexion->query($sqlCerrar);

            // 2. Buscar el siguiente en espera (el ID más antiguo)
            $sqlBuscar = "SELECT id FROM alumnos_turnos WHERE estado = 'espera' ORDER BY id ASC LIMIT 1";
            $stmt = $this->conexion->prepare($sqlBuscar);
            $stmt->execute();
            $siguiente = $stmt->fetch(PDO::FETCH_ASSOC);

            // 3. Si hay alguien esperando, ponerlo como atendido
            if ($siguiente) {
                $sqlAbrir = "UPDATE alumnos_turnos SET estado = 'atendido' WHERE id = ?";
                $stmtUpd = $this->conexion->prepare($sqlAbrir);
                $stmtUpd->execute([$siguiente['id']]);
            }
        }
    }
?>
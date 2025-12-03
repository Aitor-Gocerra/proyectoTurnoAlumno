-- 1. Crear la base de datos
CREATE DATABASE IF NOT EXISTS gestion_turnos;
USE gestion_turnos;

-- 2. Crear la tabla de turnos
CREATE TABLE alumnos_turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,     -- Este será el número de turno
    nombre VARCHAR(100) NOT NULL,          -- Nombre del alumno
    estado ENUM('espera', 'atendido', 'finalizado') DEFAULT 'espera', -- Estado del turno
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

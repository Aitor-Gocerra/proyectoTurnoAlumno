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

-- 3. Insertar datos de prueba (para que veas algo en pantalla)
INSERT INTO alumnos_turnos (nombre, estado) VALUES 
('Laura Martínez', 'atendido'), -- La que está pasando ahora
('Carlos Ruiz', 'espera'),
('Ana Gómez', 'espera'),
('Pedro Sánchez', 'espera'),
('Lucía Fernández', 'espera'),
('Miguel Ángel', 'espera'),
('Sofía López', 'espera'),
('Javier García', 'espera'),
('Elena Pérez', 'espera'),
('Pablo Díaz', 'espera'),
('Marta Ruiz', 'espera'),
('Jorge Vega', 'espera');
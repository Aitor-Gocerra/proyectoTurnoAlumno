<?php
    require_once __DIR__ . '/../modelos/mAlumnos.php';

    class CAlumnos {

        private $accion;      // Instancia del Modelo
        public $mensaje;      // Mensajes de éxito/error
        public $vista;        // Nombre de la vista a cargar
        public $lista_turnos; // ARRAY para pasar los datos a la vista

        public function __construct(){
            $this->accion = new Alumno();
            $this->vista = '';
            $this->mensaje = '';
            $this->lista_turnos = [];
        }

        public function index(){

            $this->lista_turnos = $this->accion->obtenerSiguientes();
            $this->vista = 'dashboard';

        }

        public function registrar(){
            
            $nombre = trim($_POST['nombre']); // Limpiamos espacios
            
            // Llamamos al Modelo para insertar
            $nuevoId = $this->accion->crearTurno($nombre);

            if ($nuevoId) {
                $this->mensaje = "Turno #$nuevoId creado para $nombre.";
            } else {
                $this->mensaje = "Error al guardar el turno.";
            }
            
            // Al terminar de guardar, volvemos a cargar la lista y la vista
            $this->index(); 
        }
    }
?>
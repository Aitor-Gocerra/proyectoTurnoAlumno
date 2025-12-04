<?php
require_once RUTA_MODELOS . '/mAlumnos.php';

class CAlumnos
{

    private $accion;      // Instancia del Modelo
    public $mensaje;      // Mensajes de éxito/error
    public $vista;        // Nombre de la vista a cargar
    public $lista_turnos; // ARRAY para pasar los datos a la vista

    public function __construct()
    {
        $this->accion = new Alumno();
        $this->vista = '';
        $this->mensaje = '';
        $this->lista_turnos = [];
    }

    public function index()
    {
        $datos = [
            'lista_turnos' => $this->accion->obtenerSiguientes(),
            'turno_actual' => $this->accion->obtenerTurnoActual()
        ];

        $this->vista = 'dashboard';

        return $datos;
    }

    public function siguiente()
    {
        // Ejecutamos la lógica de avanzar turno
        $this->accion->avanzarTurno();

        // Redirigimos al index para refrescar la pantalla
        header("Location: index.php");
        exit();
    }

    public function registrar()
    {

        // Verificar que se haya enviado el formulario
        if (!isset($_POST['nombre']) || empty(trim($_POST['nombre']))) {
            $this->mensaje = "Error: Debes proporcionar un nombre.";
            return $this->index();
        }

        $nombre = trim($_POST['nombre']); // Limpiamos espacios

        // Llamamos al Modelo para insertar
        $nuevoId = $this->accion->crearTurno($nombre);

        if ($nuevoId) {
            $this->mensaje = "Turno #$nuevoId creado para $nombre.";
        } else {
            $this->mensaje = "Error al guardar el turno.";
        }

        // Al terminar de guardar, volvemos a cargar la lista y la vista
        return $this->index();
    }

    public function mostraTurnoActual()
    {

        $turno_actual = $this->accion->obtenerTurnoActual();
        $this->vista = 'turnoActual';

        return [
            'turno_actual' => $turno_actual
        ];
    }
}
?>
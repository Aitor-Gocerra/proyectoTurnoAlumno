<?php
    require_once __DIR__ . '/app/config/configDB.php';

    if (!isset($_GET['c'])) {
        $_GET['c'] = CONTROLADOR_DEFECTO;
    }

    if (!isset($_GET['m'])) {
        $_GET['m'] = METODO_DEFECTO;
    }

    $rutaControlador = RUTA_CONTROLADORES . $_GET['c'] . '.php';

    require_once $rutaControlador;

    $controlador = 'Con' . $_GET['c'];
    $objControlador = new $controlador();

    $datos = []; /* Para guardar los datos que obtenga del controlador */

    if (method_exists($objControlador, $_GET['m'])) { // Comprueba si el controlador tiene el metodo
        $datos = $objControlador->{$_GET['m']}(); // Cojo los datos
    }

    if ($objControlador->vista != '') { // Comprueba si el controlador tiene una vista
        if (is_array($datos)) { // Comprueba si los datos son un array y extrae dichos datos en forma de array asociativo para trabajar con variables claras
            extract($datos);
        }
        require_once RUTA_VISTAS . $objControlador->vista . '.php';
    }

?>
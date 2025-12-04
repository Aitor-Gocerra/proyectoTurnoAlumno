<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIDE TU VEZ</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS; ?>\estilos.css">
</head>

<body>
    <div class="container">
        
        <div class="turno-actual" id="panel-actual">
            <h2>Atendiendo a:</h2>
            <?php if ($turno_actual): ?>
                <div class="numero-gigante">Turno <?php echo $turno_actual['id']; ?></div>
                <div class="alumno-actual"><?php echo $turno_actual['nombre']; ?></div>
            <?php else: ?>
                <div class="numero-gigante">--</div>
                <div class="alumno-actual">No hay turnos activos</div>
            <?php endif; ?>

            <div style="margin-top: 20px;">
                <form action="index.php" method="GET">
                    <input type="hidden" name="c" value="Alumnos">
                    <input type="hidden" name="m" value="siguiente">
                    <button type="submit" class="btn-siguiente">
                        Llamar al Siguiente
                    </button>
                </form>
            </div>
        </div>

        <hr style="border: 0; height: 1px; background: #ddd; margin: 2rem 0;">

        <div class="registro">
            <h2>Registrar turno</h2>
            <form action="?m=registrar" method="post">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <button type="submit">Pedir turno</button>
            </form>
        </div>

        <div class="lista-espera" id="panel-siguientes">
            <h3>⏳ Siguientes en espera</h3>
            
            <?php if (!empty($lista_turnos)): ?>
                <?php foreach ($lista_turnos as $turno): ?>
                    <div class="fila-alumno">
                        <span class="turno-id">#<?php echo $turno['id']; ?></span>
                        <span class="nombre"><?php echo $turno['nombre']; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: #999; padding: 20px;">No hay turnos en espera</p>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>
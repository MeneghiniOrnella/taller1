<?php
include_once('../../components/input.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Egresado</title>
</head>
<body>
    <h1>Crear Nuevo Egresado</h1>

    <form action="../../submit.php" method="POST">
        <?php
        // Función renderInput($id, $label, $type = 'text', $required = false)

        renderInput('nombre', 'Nombre', 'text', true);
        renderInput('apellido', 'Apellido', 'text', true);
        renderInput('matricula', 'Matrícula', 'number', true);
        renderInput('email', 'Email', 'email', true);
        renderInput('telefono', 'Teléfono', 'tel', false);
        renderInput('carrera', 'Carrera', 'text', false);
        ?>

        <button type="submit">Guardar</button>
    </form>

    <a href="lista.php">Volver al listado</a>
</body>
</html>

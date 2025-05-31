<?php
include_once('../../helpers/egresados.php');
include_once('../../components/table.php');

$egresados = obtenerEgresados();

$headers = ['ID', 'Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono'];

$rows = [];
foreach ($egresados as $e) {
    $rows[] = [
        $e['id'],
        htmlspecialchars($e['nombre']),
        htmlspecialchars($e['apellido']),
        $e['matricula'],
        htmlspecialchars($e['email']),
        $e['telefono'],
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Listado de Egresados</title>
</head>
<body>
    <h1>Listado de Egresados</h1>

    <?php renderTable($headers, $rows); ?>

    <a href="crear.php">Agregar nuevo egresado</a>
</body>
</html>

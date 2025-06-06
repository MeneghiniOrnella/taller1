<?php
include_once('src/components/table.php');
include_once('src/db/connect.php');

$conn = connectDB();
if (!$conn) die("Error al conectar a la base de datos");

$res = mysqli_query($conn, "
    SELECT id, nombre
    FROM carreras
");

if (!$res) die("Error en la consulta: " . mysqli_error($conn));

$headers = ['ID', 'Nombre', 'Acciones'];
$rows = [];

while ($row = mysqli_fetch_assoc($res)) {
    $rows[] = [
        $row['id'], $row['nombre'], 'no implementado'
    ];
}

renderTable($headers, $rows);
<?php
include_once('src/components/table.php');
include_once('src/db/connect.php');

$conn = connectDB();
if (!$conn) die("Error al conectar a la base de datos");

$res = mysqli_query($conn, "
    SELECT e.id, e.nombre
    FROM egresados e
    JOIN carreras c ON e.carrera_id = c.id
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

echo "< class='block mt-4 text-green-600 text-2xl font-bold' href='form_carrera.php'>Agregar nuevo</
?>
<?php
include_once('src/components/table.php');
include_once('src/db/connect.php');

$conn = connectDB();
if (!$conn) die("Error al conectar a la base de datos");

$res = mysqli_query($conn, "
    SELECT e.id, e.nombre, e.apellido, e.matricula, e.email, e.telefono, c.nombre AS carrera, e.estado
    FROM egresados e
    JOIN carreras c ON e.carrera_id = c.id
");

if (!$res) die("Error en la consulta: " . mysqli_error($conn));

$headers = ['ID', 'Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono', 'Carrera', 'Estado', 'Acciones'];
$rows = [];

while ($row = mysqli_fetch_assoc($res)) {
    // echo "<pre>"; print_r($row); echo "</pre>";
    // NO FUNCIONA
    // $acciones = "<a href='form_egresado.php?id={$row['id']}' class='text-blue-500 underline'>Editar</a> | " . "<a href='delete_egresado.php?id={$row['id']}' class='text-red-500 underline' onclick='return confirm(\"¿Eliminar?\")'>Eliminar</a>";

    $rows[] = [
        $row['id'], $row['nombre'], $row['apellido'], $row['matricula'], $row['email'],
        $row['telefono'], $row['carrera'], $row['estado'], 'no implementado'
    ];
}

renderTable($headers, $rows);

echo "<a class='block mt-4 text-green-600 text-2xl font-bold' href='form_egresado.php'>Agregar nuevo</a>";
?>

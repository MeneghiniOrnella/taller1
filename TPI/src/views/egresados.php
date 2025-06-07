<?php
global $conn;

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);

    echo "<p>Intentando eliminar ID: $id</p>"; // DEBUG

    $sql = "DELETE FROM egresados WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "<p class='text-red-600'>Error al ejecutar DELETE: " . mysqli_error($conn) . "</p>";
    } else {
        if (mysqli_affected_rows($conn) === 0) {
            echo "<p class='text-yellow-600'>No se encontró ningún registro con ID = $id</p>";
        } else {
            echo "<p class='text-green-600'>Registro con ID = $id eliminado correctamente.</p>";
        }
    }
}

renderQueryTable(
    $conn,
    "SELECT e.id, e.nombre, e.apellido, e.matricula, e.email, e.telefono, c.nombre AS carrera, e.estado
    FROM egresados e
    JOIN carreras c ON e.carrera_id = c.id",
    ['Id', 'Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono', 'Carrera', 'Estado'],
    function($row) {
        return [$row['id'], $row['nombre'], $row['apellido'], $row['matricula'], $row['email'], $row['telefono'], $row['carrera'], $row['estado']];
    }
);
?>
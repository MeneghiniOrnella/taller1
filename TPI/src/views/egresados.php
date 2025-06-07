<?php
renderQueryTable(
    $conn,
    "SELECT e.id, e.nombre, e.apellido, e.matricula, e.email, e.telefono, c.nombre AS carrera, e.estado
    FROM egresados e
    JOIN carreras c ON e.carrera_id = c.id",
    ['Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono', 'Carrera', 'Estado'],
    function($row) {
        return [$row['nombre'], $row['apellido'], $row['matricula'], $row['email'], $row['telefono'], $row['carrera'], $row['estado']];
    }
);
?>
<?php
renderQueryTable(
    $conn,
    "SELECT e.id, e.nombre, e.apellido, e.matricula, e.email, e.telefono, c.nombre AS carrera, e.estado
    FROM egresados e
    JOIN carreras c ON e.carrera_id = c.id",
    ['ID', 'Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono', 'Carrera', 'Estado', 'Acciones'],
    function($row) {
        return [$row['id'], $row['nombre'], $row['apellido'], $row['matricula'], $row['email'],
        $row['telefono'], $row['carrera'], $row['estado'],  'no implementado'];
    }
);
?>
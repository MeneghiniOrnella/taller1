<?php
$table = 'carreras';
renderQueryTable(
    $conn,
    "SELECT id, nombre FROM $table",
    ['id', 'Carrera'],
    function($row) {
        return [$row['id'], $row['nombre']];
    },
    $table
);
?>

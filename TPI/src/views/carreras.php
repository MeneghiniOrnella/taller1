<?php
global $conn;

renderForm([
    'action' => 'index.php?tabla=carreras',
    'method' => 'post',
    'title' => 'Agregar nueva carrera',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'carreras'],
        ['name' => 'nombre', 'label' => 'Nombre de la carrera', 'required' => true],
    ]
]);

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

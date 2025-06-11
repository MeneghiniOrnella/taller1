<?php
global $conn;

renderForm([
    'action' => 'dashboard.php?tabla=carreras',
    'method' => 'post',
    'title' => 'Agregar nueva carrera',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'carreras'],
        ['name' => 'nombre', 'label' => 'Nombre de la carrera', 'required' => true],
    ]
]);

renderQueryTable(
    $conn,
    "SELECT id, nombre FROM $table",
    ['id', 'Carrera'],
    function($row) {
        return [$row['id'], $row['nombre']];
    },
    'carreras'
);
?>

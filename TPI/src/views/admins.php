<?php
global $conn;

renderForm([
    'action' => 'index.php?tabla=admins',
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
    "SELECT id, usuario, password FROM admins",
    ['Usuario', 'Contraseña'],
    function($row) {
        return [$row['usuario'], $row['password']];
    },
    'admins'
);
?>
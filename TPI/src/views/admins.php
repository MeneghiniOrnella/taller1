<?php
global $conn;

renderForm([
    'action' => 'dashboard.php?tabla=admins',
    'method' => 'post',
    'title' => 'Agregar nuevo usuario administrador',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'admins'],
        ['name' => 'usuario', 'label' => 'Usuario', 'required' => true],
        ['name' => 'password', 'label' => 'Contraseña', 'required' => true],
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
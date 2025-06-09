<?php
global $conn;

renderForm([
    'action' => 'index.php?tabla=admins',
    'method' => 'post',
    'title' => 'Inicio de sesión',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'admins'],
        ['name' => 'nombre', 'label' => 'usuario', 'required' => true],
        ['name' => 'nombre', 'label' => 'password', 'required' => true],
    ]
]);
?>
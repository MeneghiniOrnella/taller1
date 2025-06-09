<?php
global $conn;

renderForm([
    'action' => 'index.php?tabla=login',
    'method' => 'post',
    'title' => 'Agregar nuevo administrador',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'carreras'],
        ['name' => 'nombre', 'label' => 'Nombre de la carrera', 'required' => true],
    ]
]);
?>
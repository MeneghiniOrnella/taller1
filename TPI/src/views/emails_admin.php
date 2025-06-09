<?php
global $conn;

renderForm([
    'action' => 'index.php?tabla=emails_admin',
    'method' => 'post',
    'title' => 'Agregar nuevo email de administrador',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'carreras'],
        ['name' => 'email', 'label' => 'Email', 'required' => true],
    ]
]);

renderQueryTable(
    $conn,
    "SELECT id, email FROM emails_admin",
    ['Email'],
    function($row) {
        return [$row['email']];
    },
    'emails_admin'
);
?>
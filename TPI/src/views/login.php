<?php
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/form.php';
require_once __DIR__ . '/../components/footer.php';
global $conn;

renderHeader('Inicio de sesión', 'login');

renderForm([
    'action' => 'dashboard.php?tabla=admins',
    'method' => 'post',
    'title' => 'Inicio de sesión',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'admins'],
        ['name' => 'usuario', 'label' => 'Usuario', 'required' => true],
        ['name' => 'password', 'label' => 'Contraseña', 'required' => true],
    ]
]);

renderFooter();
?>

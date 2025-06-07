<?php
session_start();
include_once(__DIR__ . '/../components/form.php');
include_once(__DIR__ . '/../components/header.php');

$formData = [
    'title' => 'Iniciar sesión',
    'action' => '../auth/loginHandler.php', // ¡Muy importante!
    'method' => 'post',
    'useAlerts' => true,
    'submit' => 'Entrar',
    'fields' => [
        [
            'name' => 'usuario',
            'label' => 'Usuario',
            'type' => 'text',
            'required' => true,
            'value' => $_SESSION['old']['usuario'] ?? ''
        ],
        [
            'name' => 'password',
            'label' => 'Contraseña',
            'type' => 'password',
            'required' => true,
            'value' => ''
        ]
    ]
];

unset($_SESSION['old']);

renderForm($formData);
include_once(__DIR__ . '/../components/footer.php');
?>

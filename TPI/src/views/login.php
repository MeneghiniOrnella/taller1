<?php
include_once(__DIR__ . '/../components/form.php');

$formData = [
    'action' => '/../auth/loginHandler.php',
    'method' => 'post',
    'title' => 'Iniciar sesión',
    'submit' => 'Entrar',
    'useAlerts' => true,
    'fields' => [
        [
            'name' => 'usuario', 
            'label' => 'Usuario', 
            'type' => 'text', 
            'required' => true
        ],
        [
            'name' => 'password', 
            'label' => 'Contraseña', 
            'type' => 'password', 
            'required' => true
        ]
    ]
];

renderForm($formData);
?>
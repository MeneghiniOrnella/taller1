<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('Location: ../dashboard.php');
    exit;
}

$formData = [
    'action' => '../../actions/admin_login.php',
    'method' => 'post',
    'submit' => 'Iniciar sesión',
    'useAlerts' => true,
    'fields' => [
        [
            'name' => 'email',
            'label' => 'Correo electrónico',
            'type' => 'email',
            'isRequired' => true,
        ],
        [
            'name' => 'password',
            'label' => 'Contraseña',
            'type' => 'password',
            'isRequired' => true,
        ]
    ]
];
include('../../components/form.php');
?>
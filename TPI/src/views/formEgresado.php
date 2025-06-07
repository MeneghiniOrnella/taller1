<?php
session_start();
include_once(__DIR__ . '/../components/form.php');
include_once(__DIR__ . '/../components/header.php');

$formData = [
    'title' => 'Ingrese sus datos',
    'action' => '',
    'method' => 'post',
    'useAlerts' => true,
    'submit' => 'Enviar',
    'fields' => [
        [
            'name' => 'nombre',
            'label' => 'Nombre',
            'type' => 'text',
            'required' => true,
            'value' => $_SESSION['old']['nombre'] ?? ''
        ],
        [
            'name' => 'apellido',
            'label' => 'Apellido',
            'type' => 'text',
            'required' => true,
            'value' => $_SESSION['old']['apellido'] ?? ''
        ],
        [
            'name' => 'carrera',
            'label' => 'Carrera',
            'type' => 'text',
            'required' => true,
            'value' => $_SESSION['old']['carrera'] ?? ''
        ],
        [
            'name' => 'matricula',
            'label' => 'Matrícula',
            'type' => 'int',
            'required' => true,
            'value' => $_SESSION['old']['matricula'] ?? ''
        ],
        [
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email',
            'required' => true,
            'value' => $_SESSION['old']['email'] ?? ''
        ],
        [
            'name' => 'telefono',
            'label' => 'Teléfono',
            'type' => 'int',
            'required' => true,
            'value' => $_SESSION['old']['telefono'] ?? ''
        ],
    ]
];

unset($_SESSION['old']);

renderForm($formData);
include_once(__DIR__ . '/../components/footer.php');
?>

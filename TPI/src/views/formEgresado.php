<?php
session_start();
include_once(__DIR__ . '/../components/form.php');
include_once(__DIR__ . '/../components/header.php');

renderHeader();
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
            'value' => ''
        ],
        [
            'name' => 'apellido',
            'label' => 'Apellido',
            'type' => 'text',
            'required' => true,
            'value' => ''
        ],
        [
            'name' => 'carrera',
            'label' => 'Carrera',
            'type' => 'text',
            'required' => true,
            'value' => ''
        ],
        [
            'name' => 'matricula',
            'label' => 'Matrícula',
            'type' => 'int',
            'required' => true,
            'value' => ''
        ],
        [
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email',
            'required' => true,
            'value' => ''
        ],
        [
            'name' => 'telefono',
            'label' => 'Teléfono',
            'type' => 'int',
            'required' => true,
            'value' => ''
        ],
    ]
];

renderForm($formData);
include_once(__DIR__ . '/../components/footer.php');

renderFooter();
?>

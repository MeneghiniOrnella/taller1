<?php
$formData = [
    'title' => 'Crear Nuevo Egresado',
    'action' => '../../submit.php',
    'method' => 'POST',
    'submit' => 'Guardar',
    'useAlerts' => true,
    'fields' => [
        ['name' => 'nombre', 'label' => 'Nombre', 'type' => 'text', 'required' => true],
        ['name' => 'apellido', 'label' => 'Apellido', 'type' => 'text', 'required' => true],
        ['name' => 'matricula', 'label' => 'Matrícula', 'type' => 'number', 'required' => true],
        ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
        ['name' => 'telefono', 'label' => 'Teléfono', 'type' => 'tel'],
        ['name' => 'carrera', 'label' => 'Carrera', 'type' => 'text'],
    ]
];

include_once(__DIR__ . '/../../components/form.php');

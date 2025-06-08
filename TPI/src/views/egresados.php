<?php
global $conn;
include_once(__DIR__ . '/../components/form.php');

renderForm([
    'action' => 'index.php?tabla=egresados',
    'method' => 'post',
    'title' => 'Agregar nuevo egresado',
    'submit' => 'Agregar',
    'fields' => [
        ['name' => 'tabla', 'type' => 'hidden', 'value' => 'egresados'],
        ['name' => 'nombre', 'label' => 'Nombre', 'required' => true],
        ['name' => 'apellido', 'label' => 'Apellido', 'required' => true],
        ['name' => 'matricula', 'label' => 'Matrícula', 'type' => 'number', 'required' => true],
        ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
        ['name' => 'telefono', 'label' => 'Teléfono', 'type' => 'text'],
        ['name' => 'carrera_id', 'label' => 'Carrera ID', 'type' => 'number', 'required' => true],
        ['name' => 'estado', 'label' => 'Estado', 'required' => false],
    ]
]);

renderQueryTable(
    $conn,
    "SELECT e.id, e.nombre, e.apellido, e.matricula, e.email, e.telefono, c.nombre AS carrera, e.estado
    FROM egresados e
    JOIN carreras c ON e.carrera_id = c.id",
    ['Id', 'Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono', 'Carrera', 'Estado'],
    function($row) {
        return [$row['id'], $row['nombre'], $row['apellido'], $row['matricula'], $row['email'], $row['telefono'], $row['carrera'], $row['estado']];
    },
    'egresados',
);
?>
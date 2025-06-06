<?php
require_once 'src/db/connect.php';
include_once 'src/components/form.php';

$conn = connectDB();
$id = $_GET['id'] ?? null;
$datos = ['nombre' => '', 'apellido' => '', 'matricula' => '', 'email' => '', 'telefono' => '', 'estado' => 'pendiente', 'carrera_id' => 1];

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM egresados WHERE id = $id");
    $datos = mysqli_fetch_assoc($res);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    if ($id) {
        $sql = "UPDATE egresados SET nombre='$nombre', apellido='$apellido', matricula=$matricula,
                email='$email', telefono=$telefono, carrera_id=$carrera_id, estado='$estado' WHERE id=$id";
    } else {
        $sql = "INSERT INTO egresados (nombre, apellido, matricula, email, telefono, carrera_id, estado)
                VALUES ('$nombre', '$apellido', $matricula, '$email', $telefono, $carrera_id, '$estado')";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php?tabla=egresados");
    exit;
}

$formData = [
    'title' => $id ? 'Editar Egresado' : 'Nuevo Egresado',
    'action' => '',
    'method' => 'post',
    'submit' => 'Guardar',
    'fields' => [
        ['name' => 'nombre', 'label' => 'Nombre', 'value' => $datos['nombre'], 'required' => true],
        ['name' => 'apellido', 'label' => 'Apellido', 'value' => $datos['apellido'], 'required' => true],
        ['name' => 'matricula', 'label' => 'Matrícula', 'value' => $datos['matricula'], 'type' => 'number', 'required' => true],
        ['name' => 'email', 'label' => 'Email', 'value' => $datos['email'], 'type' => 'email', 'required' => true],
        ['name' => 'telefono', 'label' => 'Teléfono', 'value' => $datos['telefono'], 'type' => 'tel'],
        ['name' => 'carrera_id', 'label' => 'ID Carrera', 'value' => $datos['carrera_id'], 'type' => 'number', 'required' => true],
        ['name' => 'estado', 'label' => 'Estado', 'value' => $datos['estado'], 'required' => true],
    ]
];

renderForm($formData);

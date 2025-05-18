<?php
include('../config/db.php');

$conn = connectDB();

$campos = ['nombre', 'apellido', 'carrera', 'matricula', 'email', 'telefono'];
$datos = [];

foreach ($campos as $campo) {
    if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
        exit("Falta completar el campo: $campo");
    }
    $datos[$campo] = trim($_POST[$campo]);
}

guardarSolicitud($conn, $datos);

$mensaje = "Nueva solicitud de alta:\n";
foreach ($datos as $k => $v) {
    $mensaje .= ucfirst(str_replace('_', ' ', $k)) . ": $v\n";
}

$asunto = "Solicitud de alta de alumno";
$cabeceras = "From: egresados@facultad.com\r\n";

foreach (obtenerEmailsAdmins($conn) as $destinatario) {
    mail($destinatario, $asunto, $mensaje, $cabeceras);
}

header("Location: ../../index.php?success=1");
exit;

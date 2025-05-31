<?php
include('../utils/db.php');
include('helpers/validate_fields.php');
include('helpers/handle_redirect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = ['nombre', 'apellido', 'carrera', 'matricula', 'email', 'telefono'];
    $datos = validateFields($campos, $_POST);

    $stmt = mysqli_prepare($conn, "INSERT INTO egresados (nombre, apellido, carrera, matricula, email, telefono) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssss', ...array_values($datos));

    if (mysqli_stmt_execute($stmt)) {
        redirectWith('../../registro.php', 'success', 1);
    } else {
        redirectWith('../../registro.php', 'error', 1);
    }
}

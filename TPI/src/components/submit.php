<?php
include "../utils/db.php";
include "helpers/validate_fields.php";
include "helpers/handle_redirect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $campos = ["nombre", "apellido", "carrera", "matricula", "email", "telefono"];
    $datos = validateFields($campos, $_POST);

    // ESTO ME PARECE QUE NO VA
    // $stmt = mysqli_prepare($connection, "INSERT INTO egresados (nombre, apellido, carrera, matricula, email, telefono) VALUES (?, ?, ?, ?, ?, ?)");
    // mysqli_stmt_bind_param($stmt, 'ssssss', ...array_values($datos));
    // if (mysqli_stmt_execute($stmt)) {
    //     redirectWith('../../registro.php', 'success', 1);
    // } else {
    //     redirectWith('../../registro.php', 'error', 1);
    // }
}
if (mysqli_stmt_execute($stmt)) {
    $admins = mysqli_query($connection, "SELECT email FROM administradores");
    $asunto = "Nuevo registro de egresado";
    $mensaje = "Se ha registrado un nuevo egresado: {$datos["nombre"]} {$datos["apellido"]}, Matricula: {$datos["matricula"]}";
    $headers = "From: sistema@instituto.com";

    while ($admin = mysqli_fetch_assoc($admins)) {
        mail($admin["email"], $asunto, $mensaje, $headers);
    }

    redirectWith("../registro.php", "success", 1);
}

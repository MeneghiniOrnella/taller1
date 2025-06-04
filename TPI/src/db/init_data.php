<?php
require_once('email.php');

function insertInitialData(mysqli $conn): void {
    $carreras = ['Tec. en Programación', 'Contador Público', 'Lic. en Comercio Internacional', 'Tec. en Administración de Empresas'];
    foreach ($carreras as $nombre) {
        $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO carreras (nombre) VALUES (?)");
        mysqli_stmt_bind_param($stmt, 's', $nombre);
        mysqli_stmt_execute($stmt);
    }

    $admins = [
        ['usuario' => 'admin@mail.com', 'password' => password_hash('1234', PASSWORD_DEFAULT)]
    ];
    foreach ($admins as $a) {
        $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO admins (usuario, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, 'ss', $a['usuario'], $a['password']);
        mysqli_stmt_execute($stmt);
    }

    $emails_admin = ['meneghini.ornella@gmail.com'];
    foreach ($emails_admin as $email_admin) {
        $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO emails_admin (email) VALUES (?)");
        mysqli_stmt_bind_param($stmt, 's', $email_admin);
        mysqli_stmt_execute($stmt);
    }

    mysqli_query($conn, "DELETE FROM egresados");
    $res = mysqli_query($conn, "SELECT id FROM carreras LIMIT 1");
    $carrera_id = mysqli_fetch_assoc($res)['id'] ?? 1;
    for ($i = 1; $i <= 4; $i++) {
    $stmt = mysqli_prepare($conn,
        "INSERT INTO egresados (nombre, apellido, matricula, email, telefono, carrera_id, estado)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $nombre = "Nombre$i";
    $apellido = "Apellido$i";
    $matricula = 1000 + $i;
    $email = "correo$i@example.com";
    $telefono = 1234567890 + $i;
    $estado = 'pendiente';

    mysqli_stmt_bind_param($stmt, 'ssissis', $nombre, $apellido, $matricula, $email, $telefono, $carrera_id, $estado);
    mysqli_stmt_execute($stmt);

    sendEmailToAdmins($conn, $nombre, $apellido, $email);
}

}

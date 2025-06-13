<?php
function insertInitialData(mysqli $conn): void
{
    $resCarreras = mysqli_query($conn, "SELECT COUNT(*) as total FROM carreras");
    $rowCarreras = mysqli_fetch_assoc($resCarreras);

    $resEmailsAdmin = mysqli_query($conn, "SELECT id FROM emails_admin LIMIT 1");
    $rowEmailsAdmin = mysqli_fetch_assoc($resEmailsAdmin);

    $resAdmins = mysqli_query($conn, "SELECT id FROM admins LIMIT 1");
    $rowAdmins = mysqli_fetch_assoc($resAdmins);

    $resEgresados = mysqli_query($conn, "SELECT id FROM carreras LIMIT 1");
    $carrera_id = mysqli_fetch_assoc($resEgresados)["id"] ?? 1;
    $rowEgresados = mysqli_fetch_assoc($resEgresados);

    if (
        $rowCarreras["total"] >= 0 ||
        $rowEmailsAdmin["total"] >= 0 ||
        $rowAdmins["total"] >= 0 ||
        $rowEgresados["total"] >= 0
    ) {
        $carreras = [
            "Tec. en Programación",
            "Contador Público",
            "Lic. en Comercio Internacional",
            "Tec. en Administración de Empresas",
        ];
        foreach ($carreras as $nombre) {
            $stmtCarreras = mysqli_prepare(
                $conn,
                "INSERT IGNORE INTO carreras (nombre) VALUES (?)"
            );
            mysqli_stmt_bind_param($stmtCarreras, "s", $nombre);
            mysqli_stmt_execute($stmtCarreras);
        }

        $admins = [
            ["usuario" => "admin", "password" => password_hash("1234", PASSWORD_DEFAULT)],
            ["usuario" => "admin2", "password" => password_hash("4321", PASSWORD_DEFAULT)],
        ];
        foreach ($admins as $a) {
            $stmtAdmins = mysqli_prepare(
                $conn,
                "INSERT IGNORE INTO admins (usuario, password) 
                VALUES (?, ?)"
            );
            mysqli_stmt_bind_param($stmtAdmins, "ss", $a["usuario"], $a["password"]);
            mysqli_stmt_execute($stmtAdmins);
        }

        $emails_admin = ["m.o@gmail.com", "admin@email.com"];
        $stmtEmailsAdmin = mysqli_prepare(
            $conn,
            "INSERT IGNORE INTO emails_admin (email) 
            VALUES (?)"
        );
        foreach ($emails_admin as $email_admin) {
            mysqli_stmt_bind_param($stmtEmailsAdmin, "s", $email_admin);
            mysqli_stmt_execute($stmtEmailsAdmin);
        }

        $egresados = [
            ["Juan", "Nuñez", 1001, "juan.nunez@mail.com", 1234567890, $carrera_id, "pendiente"],
            ["Ana", "García", 1002, "ana.garcia@mail.com", 1234567891, $carrera_id, "aprobado"],
        ];
        $stmtEgresados = mysqli_prepare(
            $conn,
            "INSERT IGNORE INTO egresados (nombre, apellido, matricula, email, telefono, carrera_id, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        foreach (
            $egresados
            as [$nombre, $apellido, $matricula, $email, $telefono, $carrera, $estado]
        ) {
            mysqli_stmt_bind_param(
                $stmtEgresados,
                "ssissis",
                $nombre,
                $apellido,
                $matricula,
                $email,
                $telefono,
                $carrera,
                $estado
            );
            mysqli_stmt_execute($stmtEgresados);
        }
    }
}
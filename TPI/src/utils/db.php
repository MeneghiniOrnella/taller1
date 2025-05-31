<?php
function connectDB() {
    $connection = mysqli_connect("localhost", "root", "", "taller1-tpi");
    if (!$connection) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $connection;
}

function createTables($connection) {
    $tables = [
        "carreras" => "CREATE TABLE IF NOT EXISTS carreras (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL UNIQUE
        )",
        "egresados" => "CREATE TABLE IF NOT EXISTS egresados (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(30) NOT NULL,
            apellido VARCHAR(30) NOT NULL,
            matricula INT NOT NULL,
            email VARCHAR(50) NOT NULL,
            telefono BIGINT NOT NULL,
            carrera_id INT NOT NULL,
            estado ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente',
            FOREIGN KEY (carrera_id) REFERENCES carreras(id)
        )",
        "emails_admin" => "CREATE TABLE IF NOT EXISTS emails_admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(100) NOT NULL UNIQUE
        )",
        "admins" => "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )"
    ];

    foreach ($tables as $name => $sql) {
        if (!mysqli_query($connection, $sql)) {
            die("Error al crear tabla '$name': " . mysqli_error($connection));
        }
    }
}

function insertCarreras($connection) {
    $carreras = ['Tec. en Programación', 'Contador Público', 'Lic. en Comercio Internacional', 'Lic. en Administración de Empresas'];
    foreach ($carreras as $nombre) {
        mysqli_query($connection, "INSERT IGNORE INTO carreras (nombre) VALUES ('$nombre')");
    }
}

function insertEmailsAdmin($connection) {
    $emails = ['admin1@instituto.edu', 'admin2@instituto.edu'];
    foreach ($emails as $email) {
        mysqli_query($connection, "INSERT IGNORE INTO emails_admin (email) VALUES ('$email')");
    }
}

function insertAdmins($connection) {
    $usuarios = [
        ['usuario' => 'admin', 'password' => password_hash('admin123', PASSWORD_DEFAULT)]
    ];

    foreach ($usuarios as $admin) {
        $usuario = $admin['usuario'];
        $password = $admin['password'];
        mysqli_query($connection, "INSERT IGNORE INTO admins (usuario, password) VALUES ('$usuario', '$password')");
    }
}

function insertEgresados($connection, $cantidad = 5) {
    $result = mysqli_query($connection, "SELECT id FROM carreras LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $carrera_id = $row ? $row['id'] : 1;

    mysqli_query($connection, "DELETE FROM egresados");

    for ($i = 1; $i <= $cantidad; $i++) {
        $nombre = "Nombre$i";
        $apellido = "Apellido$i";
        $matricula = rand(1000, 9999);
        $email = "correo$i@example.com";
        $telefono = rand(1000000000, 9999999999);
        $estado = 'pendiente';

        $stmt = mysqli_prepare($connection, "INSERT INTO egresados (nombre, apellido, matricula, email, telefono, carrera_id, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssissis', $nombre, $apellido, $matricula, $email, $telefono, $carrera_id, $estado);
        mysqli_stmt_execute($stmt);
    }
}

$connection = connectDB();
createTables($connection);
insertCarreras($connection);
insertEmailsAdmin($connection);
insertAdmins($connection);
insertEgresados($connection, 4);

echo "✅ Base de datos inicializada correctamente.";
?>
<?php
function createTables(mysqli $conn): void {
    // mysqli_query($conn, "DROP TABLE IF EXISTS egresados, carreras, emails_admin, admins");

    $schemas = [
        "carreras" => [
            "id INT AUTO_INCREMENT PRIMARY KEY",
            "nombre VARCHAR(100) NOT NULL UNIQUE"
        ],
        "egresados" => [
            "id INT AUTO_INCREMENT PRIMARY KEY",
            "nombre VARCHAR(30) NOT NULL",
            "apellido VARCHAR(30) NOT NULL",
            "matricula INT NOT NULL",
            "email VARCHAR(50) NOT NULL",
            "telefono BIGINT NOT NULL",
            "carrera_id INT NOT NULL",
            "estado ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente'",
            "FOREIGN KEY (carrera_id) REFERENCES carreras(id)"
        ],
        "emails_admin" => [
            "id INT AUTO_INCREMENT PRIMARY KEY",
            "email VARCHAR(100) NOT NULL UNIQUE"
        ],
        "admins" => [
            "id INT AUTO_INCREMENT PRIMARY KEY",
            "usuario VARCHAR(50) NOT NULL UNIQUE",
            "password VARCHAR(255) NOT NULL"
        ]
    ];

    foreach ($schemas as $table => $fields) {
        $sql = "CREATE TABLE IF NOT EXISTS `$table` (\n" . implode(",\n", $fields) . "\n)";
        if (!mysqli_query($conn, $sql)) {
            throw new Exception("❌ Error al crear '$table': " . mysqli_error($conn));
        }
    }
}
?>
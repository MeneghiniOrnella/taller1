<?php
require_once 'connect.php';

function createTables(mysqli $conn): void {
    mysqli_query($conn, "DROP TABLE IF EXISTS egresados, carreras, emails_admin, admins");

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

function mostrarEgresados(mysqli $conn): void {
    $res = mysqli_query($conn, "
        SELECT e.nombre, e.apellido, e.email, e.telefono, c.nombre AS carrera
        FROM egresados e JOIN carreras c ON e.carrera_id = c.id
    ");

    echo "<h2>Egresados cargados</h2>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>Nombre | </th><th>Apellido | </th><th>Email | </th><th>Carrera | </th><th>Telefono</th></tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['nombre']} | </td>
                <td>{$row['apellido']} | </td>
                <td>{$row['carrera']} | </td>
                <td>{$row['email']} | </td>
                <td>{$row['telefono']} </td>
              </tr>";
    }
    echo "</table>";
}

// EJECUCIÓN
try {
    $conn = connectDB();
    createTables($conn);
    $alert = ['type' => 'success', 'message' => '✅ Tablas creadas e inicializadas correctamente.'];
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}
?>

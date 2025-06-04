<?php
function connectDB() {
    $conn = mysqli_connect("localhost", "root", "", "taller1-tpi");
    if (!$conn) {
        die("❌ Error de conexión: " . mysqli_connect_error());
    }
    return $conn;
}

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

    $emails = ['meneghini.ornella@gmail.com'];
    foreach ($emails as $email) {
        $stmt = mysqli_prepare($conn, "INSERT IGNORE INTO emails_admin (email) VALUES (?)");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
    }

    mysqli_query($conn, "DELETE FROM egresados");
    $res = mysqli_query($conn, "SELECT id FROM carreras LIMIT 1");
    $carrera_id = mysqli_fetch_assoc($res)['id'] ?? 1;
    for ($i = 1; $i <= 4; $i++) {
        $stmt = mysqli_prepare($conn, "INSERT INTO egresados (nombre, apellido, matricula, email, telefono, carrera_id, estado) VALUES (?, ?, ?, ?, ?, ?, 'pendiente')");
        $nombre = "Nombre$i";
        $apellido = "Apellido$i";
        $matricula = 1000 + $i;
        $email = "correo$i@example.com";
        $telefono = 1234567890 + $i;
        mysqli_stmt_bind_param($stmt, 'ssissi', $nombre, $apellido, $matricula, $email, $telefono, $carrera_id);
        mysqli_stmt_execute($stmt);

        sendEmailToAdmins($conn, $nombre, $apellido, $email);
    }
}

function sendEmailToAdmins(mysqli $conn, string $nombre, string $apellido, string $email): void {
    $subject = "Nuevo egresado registrado";
    $message = "<html>
                <body>
                    <h1>Nuevo Egresado Registrado</h1>
                    <p>Nombre: $nombre $apellido</p>
                    <p>Email: $email</p>
                </body>
               </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: egrsados@facultad.com" . "\r\n";
    $result = mysqli_query($conn, "SELECT email FROM emails_admin");
    while ($row = mysqli_fetch_assoc($result)) {
        // mail($row['email'], $subject, $message, $headers);
        echo("<div style='margin-bottom: 1rem;'>
                <strong>Asunto:</strong> $subject <br/>
                <strong>Mensaje:</strong> $message <br/>
                <strong>Headers:</strong><pre>$headers</pre>
                <strong>Email destino:</strong> {$row['email']} <br/>
                <hr/>
            </div>");
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
    insertInitialData($conn);
    $alert = ['type' => 'success', 'message' => '✅ Tablas creadas e inicializadas correctamente.'];
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicialización de Base de Datos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="p-6">
        <?php mostrarEgresados($conn); ?>
    </div>
</body>
</html>

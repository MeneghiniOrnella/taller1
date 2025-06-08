<?php
require_once __DIR__ . '/../db/connectDB.php';

function insertRow(mysqli $conn, string $table): void {
    file_put_contents(__DIR__ . '/debug.txt', "Formulario recibido\n", FILE_APPEND);

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        echo "<p class='text-red-600'>Nombre de tabla inválido.</p>";
        return;
    }

    switch ($table) {
        case 'carreras':
            $stmt = mysqli_prepare($conn, "INSERT INTO carreras (nombre) VALUES ('Nueva carrera')");
            break;

        case 'egresados':
            // Recibir datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $matricula = $_POST['matricula'] ?? 0;
            $email = $_POST['email'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $carrera_id = isset($_POST['carrera_id']) ? intval($_POST['carrera_id']) : 0;
            $estado = $_POST['estado'] ?? 'pendiente';

            if ($carrera_id <= 0) {
                echo "<p class='text-red-600'>Falta seleccionar carrera válida.</p>";
                return;
            }

            $result = mysqli_query($conn, "SELECT id FROM carreras WHERE id = $carrera_id");
            if (!$result || mysqli_num_rows($result) === 0) {
                echo "<p class='text-red-600'>La carrera seleccionada no existe.</p>";
                return;
            }

            $stmt = mysqli_prepare($conn, "
                INSERT INTO egresados 
                (nombre, apellido, matricula, email, telefono, carrera_id, estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");

            mysqli_stmt_bind_param($stmt, "ssissis", $nombre, $apellido, $matricula, $email, $telefono, $carrera_id, $estado);
            break;

        case 'emails_admin':
            $stmt = mysqli_prepare($conn, "INSERT INTO emails_admin (email) VALUES ('nuevo@correo.com')");
            break;

        case 'admins':
            $stmt = mysqli_prepare($conn, "INSERT INTO admins (usuario, password) VALUES ('usuario', 'password')");
            break;

        default:
            echo "<p class='text-red-600'>Tabla no soportada para inserción.</p>";
            return;
    }

    if (!$stmt) {
        echo "<p class='text-red-600'>Error al preparar la inserción: " . mysqli_error($conn) . "</p>";
        return;
    }

    if (!mysqli_stmt_execute($stmt)) {
        $_SESSION['alert'] = ['type' => 'error', 'message' => mysqli_stmt_error($stmt)];
    } else {
        $_SESSION['alert'] = ['type' => 'success', 'message' => "Fila insertada correctamente."];
    }


    mysqli_stmt_close($stmt);
}

// Ejecutar si se llama directamente por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tabla'])) {
    $conn = connectDB();
    insertRow($conn, $_POST['tabla']);
    // header("Location: /taller1/TPI/index.php?tabla=" . urlencode($_POST['tabla']));
    // exit;
}

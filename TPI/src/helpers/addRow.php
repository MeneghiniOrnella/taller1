<?php
require_once __DIR__ . '/../db/connectDB.php';
require_once __DIR__ . '/../components/form.php';

function insertRow(mysqli $conn, string $table): void {
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        echo "<p class='text-red-600'>Nombre de tabla inválido.</p>";
        return;
    }

    switch ($table) {
        case 'carreras':
            $nombreCarrera = trim($_POST['nombre'] ?? '');

            if ($nombreCarrera === '') {
                echo "<p class='text-red-600'>⚠️ Faltó ingresar el nombre de la carrera.</p>";
                return;
            }

            // Verificar si ya existe una carrera con ese nombre
            $query = mysqli_prepare($conn, "SELECT COUNT(*) FROM carreras WHERE nombre = ?");
            mysqli_stmt_bind_param($query, "s", $nombreCarrera);
            mysqli_stmt_execute($query);
            mysqli_stmt_bind_result($query, $count);
            mysqli_stmt_fetch($query);
            mysqli_stmt_close($query);

            if ($count > 0) {
                echo "<p class='text-red-600'>⚠️ La carrera '$nombreCarrera' ya existe en la base de datos.</p>";
                return;
            }

            // Log para debug
            file_put_contents(__DIR__ . '/debug.txt', "Insertando carrera: $nombreCarrera\n", FILE_APPEND);

            $stmt = mysqli_prepare($conn, "INSERT INTO carreras (nombre) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "s", $nombreCarrera);
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

    file_put_contents(__DIR__ . '/debug.txt', "Antes de ejecutar\n", FILE_APPEND);
    $resultado = mysqli_stmt_execute($stmt);
    file_put_contents(__DIR__ . '/debug.txt', "Después de ejecutar\n", FILE_APPEND);
    if (!$resultado) {
        $_SESSION['alert'] = ['type' => 'error', 'message' => mysqli_stmt_error($stmt)];
    } else {
        $_SESSION['alert'] = ['type' => 'success', 'message' => "Fila insertada correctamente."];
    }
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tabla'])) {
    $conn = connectDB();
    insertRow($conn, $_POST['tabla']);
    // header("Location: /taller1/TPI/index.php?tabla=" . urlencode($_POST['tabla']));
    // exit;
}
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
            $stmt = mysqli_prepare($conn, "
                INSERT INTO egresados 
                (nombre, apellido, matricula, email, telefono, carrera_id, estado) 
                VALUES ('Nombre', 'Apellido', 0, 'correo@ejemplo.com', 0, 1, 'pendiente')
            ");
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
        echo "<p class='text-red-600'>Error al insertar: " . mysqli_stmt_error($stmt) . "</p>";
    } else {
        echo "<p class='text-green-600'>Fila insertada correctamente en la tabla <strong>$table</strong>.</p>";
    }

    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tabla'])) {
    $conn = connectDB();
    insertRow($conn, $_POST['tabla']);
    header("Location: /taller1/TPI/index.php?tabla=" . urlencode($_POST['tabla']));
    exit;
}
?>

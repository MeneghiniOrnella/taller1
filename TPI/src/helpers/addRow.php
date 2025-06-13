<?php
require_once __DIR__ . "/../db/connectDB.php";
require_once __DIR__ . "/../components/form.php";

<<<<<<< HEAD
function insertRow(mysqli $conn, string $table): void {
=======
function addRow(mysqli $conn, string $table): void
{
    file_put_contents(__DIR__ . "/debug.txt", "Formulario recibido\n", FILE_APPEND);

>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        echo "<p class='text-red-600'>Nombre de tabla inválido.</p>";
        return;
    }

    switch ($table) {
<<<<<<< HEAD
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
=======
        case "carreras":
            $nombreCarreras = $_POST["nombre"] ?? "";
            $stmt = mysqli_prepare(
                $conn,
                "INSERT IGNORE INTO carreras (nombre) 
                VALUES (?)"
            );
            mysqli_stmt_bind_param($stmt, "s", $nombreCarreras);
>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5
            break;

        case "egresados":
            $nombre = $_POST["nombre"] ?? "";
            $apellido = $_POST["apellido"] ?? "";
            $matricula = $_POST["matricula"] ?? 0;
            $email = $_POST["email"] ?? "";
            $telefono = $_POST["telefono"] ?? "";
            $carrera_id = isset($_POST["carrera_id"]) ? intval($_POST["carrera_id"]) : 0;
            $estado = $_POST["estado"] ?? "pendiente";
            if ($carrera_id <= 0) {
                $alert = ["type" => "error", "message" => "Falta seleccionar carrera válida."];
                return;
            }
            $result = mysqli_query($conn, "SELECT id FROM carreras WHERE id = $carrera_id");
            if (!$result || mysqli_num_rows($result) === 0) {
                $alert = ["type" => "error", "message" => "La carrera seleccionada no existe."];
                return;
            }
            $stmt = mysqli_prepare(
                $conn,
                "INSERT IGNORE INTO egresados 
                (nombre, apellido, matricula, email, telefono, carrera_id, estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            "
            );
            mysqli_stmt_bind_param(
                $stmt,
                "ssissis",
                $nombre,
                $apellido,
                $matricula,
                $email,
                $telefono,
                $carrera_id,
                $estado
            );
            break;

        case "emails_admin":
            $emailEmails = $_POST["email"] ?? "";
            $stmt = mysqli_prepare(
                $conn,
                "INSERT IGNORE INTO emails_admin (email) 
                VALUES (?)
            "
            );
            mysqli_stmt_bind_param($stmt, "s", $emailEmails);
            break;

        case "admins":
            $usuario = $_POST["usuario"] ?? "";
            $password = $_POST["password"] ?? "";
            if (empty($usuario) || empty($password)) {
                $alert = ["type" => "error", "message" => "Faltan datos del administrador."];
                return;
            }
            $stmt = mysqli_prepare(
                $conn,
                "INSERT IGNORE INTO admins (usuario, password) 
                VALUES (?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "ss", $usuario, $password);

            file_put_contents(
                __DIR__ . "/debug.txt",
                "usuario: $usuario, password: $password\n",
                FILE_APPEND
            );

            break;

        default:
            $alert = ["type" => "error", "message" => "Tabla no soportada para inserción."];
            return;
    }

    if (!$stmt) {
        $alert = [
            "type" => "error",
            "message" => "Error al preparar la inserción: " . mysqli_error($conn),
        ];
        return;
    }
<<<<<<< HEAD

    file_put_contents(__DIR__ . '/debug.txt', "Antes de ejecutar\n", FILE_APPEND);
    $resultado = mysqli_stmt_execute($stmt);
    file_put_contents(__DIR__ . '/debug.txt', "Después de ejecutar\n", FILE_APPEND);
    if (!$resultado) {
        $_SESSION['alert'] = ['type' => 'error', 'message' => mysqli_stmt_error($stmt)];
=======
    if (!mysqli_stmt_execute($stmt)) {
        $_SESSION["alert"] = ["type" => "error", "message" => mysqli_stmt_error($stmt)];
>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5
    } else {
        $_SESSION["alert"] = ["type" => "success", "message" => "Fila insertada correctamente."];
    }
<<<<<<< HEAD
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tabla'])) {
=======

    mysqli_stmt_close($stmt);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["tabla"])) {
>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5
    $conn = connectDB();
    addRow($conn, $_POST["tabla"]);
    // header("Location: /taller1/TPI/src/views/dashboard.php?tabla=" . urlencode($_POST['tabla']));
    // exit;
}

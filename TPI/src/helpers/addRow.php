<?php
require_once __DIR__ . "/../db/connectDB.php";
require_once __DIR__ . "/../components/form.php";

function addRow(mysqli $conn, string $table): void
{
    file_put_contents(__DIR__ . "/debug.txt", "Formulario recibido\n", FILE_APPEND);

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        echo "<p class='text-red-600'>Nombre de tabla inválido.</p>";
        return;
    }

    switch ($table) {
        case "carreras":
            $nombreCarreras = $_POST["nombre"] ?? "";
            $stmt = mysqli_prepare(
                $conn,
                "INSERT IGNORE INTO carreras (nombre) 
                VALUES (?)"
            );
            mysqli_stmt_bind_param($stmt, "s", $nombreCarreras);
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
    if (!mysqli_stmt_execute($stmt)) {
        $_SESSION["alert"] = ["type" => "error", "message" => mysqli_stmt_error($stmt)];
    } else {
        $_SESSION["alert"] = ["type" => "success", "message" => "Fila insertada correctamente."];
    }

    mysqli_stmt_close($stmt);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["tabla"])) {
    $conn = connectDB();
    addRow($conn, $_POST["tabla"]);
    // header("Location: /taller1/TPI/src/views/dashboard.php?tabla=" . urlencode($_POST['tabla']));
    // exit;
}

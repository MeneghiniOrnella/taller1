<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../views/login.php");
    exit();
}

require_once __DIR__ . "/../db/db.php";
include_once __DIR__ . "/../components/header.php";
include_once __DIR__ . "/../components/footer.php";
include_once __DIR__ . "/../components/input.php";
include_once __DIR__ . "/../components/form.php";

$alert = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_SESSION["usuario"];
    $password_actual = $_POST["password_actual"] ?? "";
    $password_nueva = $_POST["password_nueva"] ?? "";
    $password_confirmacion = $_POST["password_confirmacion"] ?? "";

    if ($password_nueva !== $password_confirmacion) {
        $alert = ["type" => "error", "message" => "La nueva contraseña y su confirmación no coinciden."];
    } else {
        $query = "SELECT * FROM admins WHERE usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows === 1) {
            $admin = $res->fetch_assoc();

            if (!password_verify($password_actual, $admin["password"])) {
                $alert = ["type" => "error", "message" => "La contraseña actual es incorrecta."];
            } else {
                $hash_nuevo = password_hash($password_nueva, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE admins SET password = ? WHERE usuario = ?");
                $update->bind_param("ss", $hash_nuevo, $usuario);
                if ($update->execute()) {
                    $alert = ["type" => "success", "message" => "Contraseña actualizada correctamente."];
                } else {
                    $alert = ["type" => "error", "message" => "Error al actualizar la contraseña."];
                }
            }
        } else {
            $alert = ["type" => "error", "message" => "Usuario no encontrado."];
        }
    }
}

renderHeader([
    "Volver al panel" => "/taller1/TPI/src/views/dashboard.php"
]);

$formData = [
    "title" => "Cambiar contraseña",
    "action" => $_SERVER["PHP_SELF"],
    "method" => "post",
    "submit" => "Guardar nueva contraseña",
    "useAlerts" => true,
    "fields" => [
        [
            "name" => "password_actual",
            "label" => "Contraseña actual",
            "type" => "password",
            "required" => true
        ],
        [
            "name" => "password_nueva",
            "label" => "Nueva contraseña",
            "type" => "password",
            "required" => true
        ],
        [
            "name" => "password_confirmacion",
            "label" => "Confirmar nueva contraseña",
            "type" => "password",
            "required" => true
        ],
    ]
];

renderForm($formData);
renderFooter();
?>

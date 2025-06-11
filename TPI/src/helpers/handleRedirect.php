<?php
session_start();
include_once __DIR__ . "/../db/db.php";

$usuario = $_POST["usuario"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($usuario) || empty($password)) {
    $_SESSION["alert"] = ["type" => "error", "message" => "Usuario y contraseña requeridos"];
    $_SESSION["old"] = ["usuario" => $usuario];
    header("Location: ../views/login.php");
    exit();
}

$query = "SELECT * FROM admins WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if ($user["password"] === $password) {
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["rol"] = $user["rol"];

        if ($user["rol"] === "admin") {
            header("Location: ../admin/dashboard.php");
        } elseif ($user["rol"] === "user") {
            header("Location: ../user/home.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    }
}

$_SESSION["alert"] = ["type" => "error", "message" => "Credenciales inválidas"];
$_SESSION["old"] = ["usuario" => $usuario];
header("Location: ../views/login.php");
exit();
?>

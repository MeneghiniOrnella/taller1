<?php
session_start();
require_once __DIR__ . "/../db/db.php";
require_once __DIR__ . "/../helpers/loginAdmin.php";

$conn = connectDB();
$usuario = $_POST["usuario"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($usuario) || empty($password)) {
    $_SESSION["alert"] = ["type" => "error", "message" => "Usuario y contraseña requeridos"];
    header("Location: ../views/login.php");
    exit();
}

$admin = loginAdmin($conn, $usuario, $password);

if ($admin) {
    $_SESSION["usuario"] = $admin["usuario"];
    header("Location: ../views/dashboard.php");
    exit();
} else {
    $_SESSION["alert"] = ["type" => "error", "message" => "Credenciales inválidas"];
    header("Location: ../views/login.php");
    exit();
}

<?php
session_start();
require_once(__DIR__ . '/../db/db.php');

// var_dump($_POST);
// exit;

$conn = connectDB();
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($usuario) || empty($password)) {
    $_SESSION['alert'] = ['type' => 'error', 'message' => 'Usuario y contraseña son requeridos'];
    $_SESSION['old'] = ['usuario' => $usuario];
    header('Location: ../views/login.php');
    exit;
}

// Buscar usuario
$query = "SELECT * FROM admins WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $usuario);
$stmt->execute();
$result = $stmt->get_result();


if (password_verify($password, $user['password'])) {
    $user = $result->fetch_assoc();

    if ($user['password'] === $password) {
        // Login correcto
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];

        if ($user['rol'] === 'admin') {
            header('Location: ../admin/dashboard.php');
        } elseif ($user['rol'] === 'user') {
            header('Location: ../user/home.php');
        } else {
            header('Location: ../index.php');
        }
        exit;
    }
}

$_SESSION['alert'] = ['type' => 'error', 'message' => 'Usuario o contraseña inválidos'];
$_SESSION['old'] = ['usuario' => $usuario];
header('Location: ../views/login.php');
exit;
?>
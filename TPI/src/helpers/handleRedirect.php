<?php
session_start();
include_once(__DIR__ . '/../db/db.php'); // conexión $conn

// Obtener datos del formulario
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Validación inicial
if (empty($usuario) || empty($password)) {
    $_SESSION['alert'] = ['type' => 'error', 'message' => 'Usuario y contraseña requeridos'];
    $_SESSION['old'] = ['usuario' => $usuario];
    header('Location: ../views/login.php');
    exit;
}

// Consultar la base de datos
$query = "SELECT * FROM admins WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verificar contraseña (deberías usar password_verify si está hasheada)
    if ($user['password'] === $password) {
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];

        // Redirigir según el rol
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

// ❗ Esto debe ir después de la validación fallida
$_SESSION['alert'] = ['type' => 'error', 'message' => 'Credenciales inválidas'];
$_SESSION['old'] = ['usuario' => $usuario];
header('Location: ../views/login.php');
exit;
?>
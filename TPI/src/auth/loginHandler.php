<?php
session_start();
require_once(__DIR__ . '/../db/db.php');

var_dump($_POST);
exit;

$conn = connectDB();
$username = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['alert'] = ['type' => 'error', 'message' => 'Usuario y contraseña son requeridos'];
    $_SESSION['old'] = ['usuario' => $username];
    header('Location: ../views/login.php');
    exit;
}

$query = "SELECT * FROM admins WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['usuario'] = $user['usuario'];

    header('Location: ../index.php');
    exit;
}

$_SESSION['alert'] = ['type' => 'error', 'message' => 'Usuario o contraseña inválidos'];
$_SESSION['old'] = ['usuario' => $username];
header('Location: ../views/login.php');
exit;
?>
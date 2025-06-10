<?php
session_start();
include('../utils/db.php');
include('helpers/validate_fields.php');
include('auth/loginHandler.php');

$datos = validateFields(['email', 'password'], $_POST);

$conn = connectDB();
$query = "SELECT * FROM administradores WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $datos['email']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($result);

if ($admin && password_verify($datos['password'], $admin['password'])) {
    $_SESSION['admin'] = $admin['email'];
    header('Location: /taller1/TPI/views/dashboard.php');
} else {
    echo "Usuario o contraseña incorrectos.";
    //redirectWith('../views/auth/login.php', 'error', 1);
}

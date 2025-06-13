<?php
session_start();
<<<<<<< HEAD
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
mysqli_autocommit($conn, false);
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
=======
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
>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5

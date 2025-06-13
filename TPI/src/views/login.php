<?php
session_start();
require_once __DIR__ . "/../components/header.php";
require_once __DIR__ . "/../components/form.php";
require_once __DIR__ . "/../components/alert.php";
require_once __DIR__ . "/../components/footer.php";

$navItems = [
    "Inicio" => "/taller1/TPI/index.php",
];

renderHeader($navItems);

if (isset($_SESSION["alert"])) {
    // $alert = $_SESSION["alert"];
    // unset($_SESSION["alert"]);
    $alert = ["type" => "error", "message" => "Usuario o contraseña incorrectos."];
}

renderForm([
    "action" => "/taller1/TPI/src/auth/loginHandler.php",
    "method" => "post",
    "title" => "Inicio de sesión",
    "submit" => "Ingresar",
    "fields" => [
        ["name" => "usuario", "label" => "Usuario", "required" => true],
        ["name" => "password", "label" => "Contraseña", "type" => "password", "required" => true],
    ],
]);

renderFooter();
?>

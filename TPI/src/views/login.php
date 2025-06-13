<?php
<<<<<<< HEAD
include_once(__DIR__ . '/../components/header.php');
include_once(__DIR__ . '/../components/form.php');
include_once(__DIR__ . '/../components/footer.php');
renderHeader('Iniciar sesión');

$formData = [
    'action' => '/taller1/TPI/src/auth/loginHandler.php',
    'method' => 'post',
    'title' => 'Iniciar sesión',
    'submit' => 'Entrar',
    'useAlerts' => true,
    'fields' => [
        [
            'name' => 'usuario',
            'type' => 'text',
            'label' => 'Usuario',
            'required' => true,
            'value' => ''
        ],
        [
            'name' => 'password',
            'type' => 'password',  
            'label' => 'Contraseña',
            'required' => true,
            'value' => ''
        ]
    ]
];

renderForm($formData);

echo "<a href='/taller1/TPI/index.php' class='bg-blue-600 text-white px-4 py-2 w-2 hover:underline'>Inicio</a>";

renderFooter();
?>
=======
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
>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5

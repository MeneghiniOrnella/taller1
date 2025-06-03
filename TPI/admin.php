<?php
include_once('src/helpers/render.php');

renderPage('src/views/egresados/alta.php', [
    'pageTitle' => 'Nuevo Egresado',
    'navItems' => [
        'Inicio' => 'index.php',
        'Egresados' => 'src/views/egresados/lista.php',
        'Ingresar' => 'src/views/auth/login.php',
        'Logout' => 'src/views/auth/logout.php'
    ]
]);
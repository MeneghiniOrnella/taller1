<?php
// include_once('src/helpers/render.php');
include_once('src/components/input.php');
renderInput('src/views/egresados/lista.php', [
    'pageTitle' => 'Inicio',
    'navItems' => [
        'Inicio' => 'index.php',
        'Egresados' => 'src/views/egresados/lista.php',
        'ingresar' => 'src/views/auth/login.php',
        'Logout' => 'src/views/auth/logout.php'
    ]
]);

// include_once('src/helpers/render.php');

<?php
include_once('src/helpers/render.php');

renderPage('src/views/egresados/lista.php', [
    'pageTitle' => 'Inicio',
    'navItems' => [
        'Inicio'     => 'index.php',
        'Egresados'  => 'src/views/egresados/lista.php',
        'Ingresar'   => 'src/views/auth/login.php',
        'Logout'     => 'src/views/auth/logout.php'
    ],
    'egresados' => [
        ['nombre' => 'Juan Pérez', 'estado' => 'Graduado'],
        ['nombre' => 'Lucía Gómez', 'estado' => 'Pendiente']
    ]
]);

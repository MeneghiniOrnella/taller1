<?php
ob_start();

include_once('src/helpers/render.php');
renderPage('src/views/egresados/lista.php', [
    'pageTitle' => 'Inicio',
    'navItems' => [
        'Inicio'  => 'index.php',
        'Login'   => 'src/views/auth/login.php'
    ]
]);
include_once('src/utils/db.php');


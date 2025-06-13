<?php
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
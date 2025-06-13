<?php
session_start();

include_once "src/db/db.php";
include_once "src/helpers/addRow.php";
include_once "src/helpers/updateRow.php";
include_once "src/helpers/deleteRow.php";
include_once "src/db/init_data.php";
include_once "src/components/alert.php";
include_once "src/components/header.php";
include_once "src/helpers/renderQueryTable.php";
include_once "src/components/footer.php";

insertInitialData($conn);
$navItems = [
    "Egresados" => "/taller1/TPI/src/views/egresadoForm.php",
    "Iniciar sesión" => "/taller1/TPI/src/views/login.php",
];
renderHeader($navItems);
?>

<main class="min-h-screen flex flex-col">
    <div class="flex-1 flex flex-col items-center justify-center text-center px-4 bg-gradient-to-br from-green-50 to-green-300">
        <h1 class="text-4xl font-bold text-green-900">¡Bienvenido!</h1>
        <h2 class="text-2xl font-semibold text-green-800 mt-2">Futuros Egresados</h2>
        <p class="text-green-900 mt-4 max-w-xl">
            Si usted está pendiente de ser egresado, favor de registrarse aquí.
        </p>
        <a href="src/views/egresadoForm.php"
           class="link bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 mt-6 focus:outline-none focus:ring-2 focus:ring-green-900 focus:ring-offset-2">
            Registrar
        </a>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center text-center px-4 bg-gradient-to-br from-green-600 to-green-900">
        <h2 class="text-2xl font-semibold text-white">Administradores</h2>
        <p class="text-white mt-4 max-w-xl">
            Si usted es administrador, ingrese aquí.
        </p>
        <a href="src/views/login.php"
           class="link bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 mt-6 focus:outline-none focus:ring-2 focus:ring-green-900 focus:ring-offset-2">
            Iniciar sesión
        </a>
    </div>
</main>

<?php renderFooter(); ?>

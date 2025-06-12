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

<main class="p-6">
    <a href="src/views/login.php" class="link bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
        Iniciar sesión
    </a>
    <div class="py-4 px-4"></div>
    <a href="src/views/egresadoForm.php" class="link bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
        Registrar nuevo egresado
    </a>
</main>

<?php renderFooter(); ?>

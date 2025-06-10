<?php
session_start();

// include_once 'src/helpers/config.php';
include_once 'src/db/db.php';
// include_once 'src/helpers/deleteRow.php';
include_once 'src/helpers/addRow.php';
include_once 'src/helpers/editRow.php';
include_once 'src/db/init_data.php';
include_once 'src/components/alert.php';
include_once 'src/components/header.php';
include_once 'src/helpers/renderQueryTable.php';
include_once 'src/components/footer.php';

insertInitialData($conn);
renderHeader();
?>

<main class="p-6">
    <a href="src/views/login.php" class="link">
        Iniciar sesión
    </a>
    <div class="py-4 px-4"></div>
    <a href="src/views/egresadoForm.php" class="link">
        Registrar nuevo egresado
    </a>
</main>

<?php renderFooter(); ?>

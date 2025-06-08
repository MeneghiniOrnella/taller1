<?php
include_once 'src/components/alert.php';
include_once 'src/components/header.php';
include_once 'src/db/db.php';
include_once 'src/db/init_data.php';
include_once 'src/helpers/deleteRow.php';
include_once 'src/helpers/renderQueryTable.php';
include_once 'src/components/footer.php';

try {
    insertInitialData($conn);
    $alert = ['type' => 'success', 'message' => 'Tablas creadas e inicializadas correctamente!'];
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}
?>
<?php renderHeader(); ?>
<main class="p-6">
    <a href="src/views/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Iniciar sesión
    </a>
    <div class="bg-green-200 text-black p-4 mt-4 rounded">
        <h1>Bienvenido alumno</h1>
        <p class="mb-4">
            Si usted se quiere egresar ingrese sus datos aqui:
        </p>
        <a href="src/views/formEgresado.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 ml-4 rounded">
            Añadir Egresado
        </a>
    </div>
    <?php
    renderAlert($alert['type'], $alert['message']);
    $tables = [
        'egresados' => 'Egresados',
        'carreras' => 'Carreras',
        'emails_admin' => 'Emails de Notificación',
        'admins' => 'Cuentas de Administradores'
    ];
    ?>
    <ul class="mt-4 space-y-2">
        <?php foreach ($tables as $key => $label): ?>
        <li>
            <a href="?tabla=<?= htmlspecialchars($key) ?>" class="text-blue-600 underline">
            <?= htmlspecialchars($label) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>

    <div class="mt-6">
        <?php
        $table = $_GET['tabla'] ?? null;
        if ($table === 'egresados') {
            include 'src/views/egresados.php';
        } elseif ($table === 'admins') {
            include 'src/views/admins.php';
        } elseif ($table === 'carreras') {
            include 'src/views/carreras.php';
        } elseif ($table === 'emails_admin') {
            include 'src/views/emails_admin.php';
        } else {
            echo "<p>Seleccione una tabla para gestionar.</p>";
        }
        ?>
    </div>
</main>
<?php renderFooter(); ?>
<?php
include_once 'src/components/alert.php';
include_once 'src/components/header.php';
include_once 'src/db/db.php';
include_once 'src/db/init_data.php';
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
    <?php
    renderAlert($alert['type'], $alert['message']);
    $tablas = [
        'egresados' => 'Egresados',
        'carreras' => 'Carreras',
        'emails_admin' => 'Emails de Notificación',
        'admins' => 'Cuentas de Administradores'
    ];
    ?>
    <ul class="mt-4 space-y-2">
        <?php foreach ($tablas as $key => $label): ?>
        <li>
            <a href="?tabla=<?= htmlspecialchars($key) ?>" class="text-blue-600 underline">
            <?= htmlspecialchars($label) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>

    <div class="mt-6">
        <?php
        $tabla = $_GET['tabla'] ?? null;
        if ($tabla === 'egresados') {
            include 'src/views/egresados.php';
        } elseif ($tabla === 'admins') {
            include 'src/views/admins.php';
        } elseif ($tabla === 'carreras') {
            include 'src/views/carreras.php';
        } elseif ($tabla === 'emails_admin') {
            include 'src/views/emails_admin.php';
        } else {
            echo "<p>Seleccione una tabla para gestionar.</p>";
        }
        ?>
    </div>
</main>
<?php renderFooter(); ?>
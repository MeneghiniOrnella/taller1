<?php
include_once 'src/db/db.php';
include_once 'src/db/init_data.php';
include_once 'src/views/egresados.php';
include_once 'src/components/header.php';
include_once 'src/components/footer.php';
include_once 'src/components/alert.php';

try {
    insertInitialData($conn);
    $alert = ['type' => 'success', 'message' => 'Tablas creadas e inicializadas correctamente!'];
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}
?>
<?php renderHeader(); ?>
    <div class="p-6">
        <?php renderAlert($alert['type'], $alert['message']); ?>
        <?php if ($alert['type'] === 'success') mostrarEgresados($conn); ?>
    </div>
<?php renderFooter(); ?>
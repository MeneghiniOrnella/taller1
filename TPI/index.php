<?php
session_start();

include_once 'src/db/db.php';
include_once 'src/helpers/deleteRow.php';
include_once 'src/helpers/addRow.php';
include_once 'src/helpers/editRow.php';
include_once 'src/db/init_data.php';
include_once 'src/components/alert.php';
include_once 'src/components/header.php';
include_once 'src/helpers/renderQueryTable.php';
include_once 'src/components/footer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'], $_POST['tabla'])) {
        $id = (int)$_POST['delete_id'];
        $tabla = $_POST['tabla'];
        deleteRow($conn, $tabla, $id);
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Fila eliminada correctamente.'];
        header("Location: index.php?tabla=" . urlencode($tabla));
        exit;
    } elseif (isset($_POST['tabla'])) {
        insertRow($conn, $_POST['tabla']);
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Fila insertada correctamente.'];
        header("Location: index.php?tabla=" . urlencode($_POST['tabla']));
        exit;
    }
}

$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

try {
    insertInitialData($conn);
    if (!$alert) {
        $alert = ['type' => 'success', 'message' => 'Tablas creadas e inicializadas correctamente!'];
    }
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}

renderHeader();
?>

<main class="p-6">
    <a href="src/views/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Iniciar sesión
    </a>
    <?php
    if ($alert) renderAlert($alert['type'], $alert['message']);
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

<?php renderFooter();
<?php
session_start();
// if (!isset($_SESSION['usuario'])) {
//     header("Location: login.php");
//     exit;
// }

include_once __DIR__ . '/../db/db.php';
// include_once __DIR__ . '/../helpers/deleteRow.php';
include_once __DIR__ . '/../helpers/addRow.php';
include_once __DIR__ . '/../helpers/editRow.php';
include_once __DIR__ . '/../components/alert.php';
include_once __DIR__ . '/../components/header.php';
include_once __DIR__ . '/../helpers/renderQueryTable.php';
include_once __DIR__ . '/../components/footer.php';

renderHeader();

// echo "<h1>Bienvenido!!!</h1>";
echo "<a href='logout.php' class='link bg-red-500 hover:bg-red-700'>Cerrar sesión</a>";

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['delete_id'], $_POST['tabla'])) {
//         $id = (int)$_POST['delete_id'];
//         $tabla = $_POST['tabla'];
//         deleteRow($conn, $tabla, $id);
//         $_SESSION['alert'] = ['type' => 'success', 'message' => 'Fila eliminada correctamente.'];
//         header("Location: index.php?tabla=" . urlencode($tabla));
//         exit;
//     } elseif (isset($_POST['tabla'])) {
//         insertRow($conn, $_POST['tabla']);
//         $_SESSION['alert'] = ['type' => 'success', 'message' => 'Fila insertada correctamente.'];
//         header("Location: index.php?tabla=" . urlencode($_POST['tabla']));
//         exit;
//     }
// }

if ($alert && isset($alert['type'], $alert['message'])) {
    renderAlert($alert['type'], $alert['message']);
}

try {
    // insertInitialData($conn);
    if (!$alert) {
        $alert = ['type' => 'success', 'message' => 'Tablas creadas e inicializadas correctamente!'];
    }
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}
?>

<main class="p-6">
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
            include __DIR__ . '/egresados.php';
        } elseif ($table === 'admins') {
            include __DIR__ . '/admins.php';
        } elseif ($table === 'carreras') {
            include __DIR__ . '/carreras.php';
        } elseif ($table === 'emails_admin') {
            include __DIR__ . '/emails_admin.php';
        } else {
            echo "<p>Seleccione una tabla para gestionar.</p>";
        }
        ?>
    </div>
</main>

<?php renderFooter(); ?>
<?php
session_start();
include_once __DIR__ . '/../db/db.php';
include_once __DIR__ . '/../helpers/addRow.php';
include_once __DIR__ . '/../components/header.php';
include_once __DIR__ . '/../components/alert.php';
include_once __DIR__ . '/../components/form.php';
include_once __DIR__ . '/../components/footer.php';
include_once __DIR__ . '/../helpers/sendEmailToAdmins.php';
include_once __DIR__ . '/../helpers/redirect.php';
include_once __DIR__ . '/../helpers/renderQueryTable.php';

$datosEnviados = $_SESSION['datosEnviados'] ?? null;
unset($_SESSION['datosEnviados']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tabla']) && $_POST['tabla'] === 'egresados') {
    insertRow($conn, 'egresados');
    $_SESSION['datosEnviados'] = $_POST;
    $_SESSION['alert'] = ['type' => 'success', 'message' => 'Egresado agregado correctamente.'];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

renderHeader();
?>

<main class="p-6">
    <?php if ($alert) renderAlert($alert['type'], $alert['message']); ?>

    <?php
    renderForm([
        'action' => $_SERVER['PHP_SELF'],
        'method' => 'post',
        'title' => 'Formulario de Egresado',
        'submit' => 'Agregar Egresado',
        'tabla' => 'egresados',
        'fields' => [
            ['name' => 'nombre', 'label' => 'Nombre', 'required' => true],
            ['name' => 'apellido', 'label' => 'Apellido', 'required' => true],
            ['name' => 'matricula', 'label' => 'Matrícula', 'type' => 'number', 'required' => true],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
            ['name' => 'telefono', 'label' => 'Teléfono', 'type' => 'text'],
            ['name' => 'carrera_id', 'label' => 'Carrera ID', 'type' => 'number', 'required' => true],
            ['name' => 'estado', 'label' => 'Estado'],
        ]
    ]);
    ?>

    <?php if (!empty($datosEnviados)): ?>
        <div class="max-w-md mx-auto mt-6 bg-gray-50 p-4 rounded-lg border border-gray-300 shadow">
            <h3 class="text-xl font-semibold mb-4">Datos Enviados:</h3>
            <ul class="list-disc list-inside text-gray-700">
                <?php foreach ($datosEnviados as $key => $value): ?>
                    <?php if ($key !== 'tabla'): ?>
                        <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</main>

<?php
//sendEmailToAdmins($conn, $nombre, $apellido, $email, $telefono);

renderFooter(); 
?>
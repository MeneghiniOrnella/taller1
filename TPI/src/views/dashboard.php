<?php
session_start();
// if (!isset($_SESSION['usuario'])) {
//     header("Location: login.php");
//     exit;
// }

include_once __DIR__ . "/../db/db.php";
include_once __DIR__ . "/../helpers/deleteRow.php";
include_once __DIR__ . "/../helpers/addRow.php";
include_once __DIR__ . "/../helpers/updateRow.php";
include_once __DIR__ . "/../components/alert.php";
include_once __DIR__ . "/../components/header.php";
include_once __DIR__ . "/../helpers/renderQueryTable.php";
include_once __DIR__ . "/../components/footer.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: ../views/login.php");
    exit();
}

$usuario = $_SESSION["usuario"];
$usuarioImg = "
    <span class='usuarioImg'>
        <img src='/taller1/TPI/public/assets/admin.png' alt='admin'>
        $usuario
    </span>";

$navItems = [
    $usuarioImg => "",
    "Cerrar sesión" => "/taller1/TPI/src/views/logout.php",
];

renderHeader($navItems);

// print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete_id"], $_POST["tabla"])) {
        // DELETE
        $id = (int) $_POST["delete_id"];
        $tabla = $_POST["tabla"];
        deleteRow($conn, $tabla, $id);
        $_SESSION["alert"] = ["type" => "success", "message" => "Fila eliminada correctamente."];
    } elseif (isset($_POST["tabla"])) {
        // CREATE
        addRow($conn, $_POST["tabla"]);
        $_SESSION["alert"] = ["type" => "success", "message" => "Fila insertada correctamente."];
    } elseif (isset($_POST["update_id"], $_POST["tabla"])) {
        // UPDATE
        $id = (int) $_POST["update_id"];
        updateRow($conn, $_POST["tabla"], $_POST, "id", $id);
        $_SESSION["alert"] = ["type" => "success", "message" => "Fila actualizada correctamente."];
    } elseif (isset($_POST["login_id"], $_POST["tabla"])) {
        // LOGIN
        $id = (int) $_POST["login_id"];
        loginRow($conn, $_POST["tabla"], $_POST, "id", $id);
        $_SESSION["alert"] = ["type" => "success", "message" => "Datos de ingreso correctos."];
    } else {
        $_SESSION["alert"] = ["type" => "error", "message" => "Acción no soportada."];
    }
}

if ($alert && isset($alert["type"], $alert["message"])) {
    renderAlert($alert["type"], $alert["message"]);
}

try {
    // insertInitialData($conn);
    if (!$alert) {
        $alert = [
            "type" => "success",
            "message" => "Tablas creadas e inicializadas correctamente!",
        ];
    }
} catch (Exception $e) {
    $alert = ["type" => "error", "message" => $e->getMessage()];
}
?>

<main class="p-6">
    <?php
    if ($alert) {
        renderAlert($alert["type"], $alert["message"]);
    }

    $tables = [
        "egresados" => "Egresados",
        "carreras" => "Carreras",
        "emails_admin" => "Emails de Notificación",
        "admins" => "Cuentas de Administradores",
    ];
    ?>

<div class="flex">
    <aside class="w-64 h-screen sticky top-0 bg-green-50 p-4 shadow-lg border-r border-green-200">
        <h2 class="text-xl font-bold text-green-900 mb-4 text-center">Tablas disponibles:</h2>
        <ul class="space-y-2">
            <?php foreach ($tables as $key => $label): ?>
            <li>
                <a href="?tabla=<?= htmlspecialchars($key) ?>"
                   class="block px-4 py-2 rounded bg-green-700 text-white hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-900 focus:ring-offset-2 transition">
                    <?= htmlspecialchars($label) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <main class="flex-1 p-10">
        <?php
        if ($alert) {
            renderAlert($alert["type"], $alert["message"]);
        }

        $table = $_GET["tabla"] ?? null;
        if ($table === "egresados") {
            include __DIR__ . "/egresados.php";
        } elseif ($table === "changePassword") {
            include __DIR__ . "/changePassword.php";
        } elseif ($table === "carreras") {
            include __DIR__ . "/carreras.php";
        } elseif ($table === "emails_admin") {
            include __DIR__ . "/emails_admin.php";
        } else {
            $alert = ["type" => "error", "message" => "Seleccione una tabla para gestionar."];
        }
        ?>
    </main>
</div>

<?php renderFooter(); ?>

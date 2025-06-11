<?php
session_start();
include_once __DIR__ . "/../db/db.php";
include_once __DIR__ . "/../helpers/addRow.php";
include_once __DIR__ . "/../helpers/email.php";
include_once __DIR__ . "/../components/header.php";
include_once __DIR__ . "/../components/alert.php";
include_once __DIR__ . "/../components/form.php";
include_once __DIR__ . "/../components/footer.php";

$datosEnviados = null;

// print_r($_POST);

if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["tabla"]) &&
    $_POST["tabla"] === "egresados"
) {
    $camposRequeridos = ["nombre", "apellido", "matricula", "email", "carrera_id"];

    $faltantes = [];
    foreach ($camposRequeridos as $campo) {
        if (empty($_POST[$campo])) {
            $faltantes[] = $campo;
        }
    }

    if (!empty($faltantes)) {
        $alert = [
            "type" => "error",
            "message" =>
                "Faltan completar los siguientes campos obligatorios: " . implode(", ", $faltantes),
        ];
    } else {
        try {
            insertRow($conn, "egresados");
            $datosEnviados = $_POST;
            $alert = ["type" => "success", "message" => "Egresado agregado correctamente."];
        } catch (Exception $e) {
            $alert = ["type" => "error", "message" => "Error al insertar: " . $e->getMessage()];
        }
    }
}

$navItems = [
    "Inicio" => "/taller1/TPI/index.php",
    "Iniciar sesión" => "/taller1/TPI/src/views/login.php",
    "Egresados" => "/taller1/TPI/src/views/login.php",
];
renderHeader($navItems);
?>

<main class="p-6">
    <?php if ($alert) {
        renderAlert($alert["type"], $alert["message"]);
    } ?>

    <?php
    renderForm([
        "action" => $_SERVER["PHP_SELF"],
        "method" => "post",
        "title" => "Formulario de Egresado",
        "submit" => "Agregar Egresado",
        "tabla" => "egresados",
        "fields" => [
            ["name" => "nombre", "label" => "Nombre", "required" => true],
            ["name" => "apellido", "label" => "Apellido", "required" => true],
            ["name" => "matricula", "label" => "Matrícula", "type" => "number", "required" => true],
            ["name" => "email", "label" => "Email", "type" => "email", "required" => true],
            ["name" => "telefono", "label" => "Teléfono", "type" => "text"],
            [
                "name" => "carrera_id",
                "label" => "Carrera ID",
                "type" => "number",
                "required" => true,
            ],
        ],
    ]);

    if (!empty($faltantes)) {
        $alert = [
            "type" => "error",
            "message" =>
                "Faltan completar los siguientes campos obligatorios: " . implode(", ", $faltantes),
        ];
    } else {
        try {
            $_POST["estado"] = "pendiente";
            insertRow($conn, "egresados");
            $datosEnviados = $_POST;
            $alert = ["type" => "success", "message" => "Egresado agregado correctamente."];
        } catch (Exception $e) {
            $alert = ["type" => "error", "message" => "Error al insertar: " . $e->getMessage()];
        }
    }
    ?>

    <?php if (!empty($datosEnviados)): ?>
        <div class="max-w-md mx-auto mt-6 bg-gray-50 p-4 rounded-lg border border-gray-300 shadow">
            <h3 class="text-xl font-semibold mb-4">Datos Enviados:</h3>
            <ul class="list-disc list-inside text-gray-700">
                <?php foreach ($datosEnviados as $key => $value): ?>
                    <?php if ($key !== "tabla"): ?>
                        <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars(
    $value
) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</main>

<?php
if(!empty($datosEnviados)) {
    $nombre = $datosEnviados["nombre"] ?? "";
    $apellido = $datosEnviados["apellido"] ?? "";
    $email = $datosEnviados["email"] ?? "";
    $telefono = $datosEnviados["telefono"] ?? "";
}
if ($nombre && $apellido && $email && $telefono) {
    sendEmailToAdmins($conn, $nombre, $apellido, $email, $telefono);
}

renderFooter();

?>

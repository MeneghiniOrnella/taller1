<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

<<<<<<< HEAD
include_once 'src/components/alert.php';
include_once 'src/components/header.php';
include_once 'src/db/db.php';
$conn = connectDB();
if (!$conn) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

include_once 'src/helpers/deleteRow.php';
include_once 'src/helpers/addRow.php';
include_once 'src/helpers/editRow.php';

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

// Carga de alertas si existen
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

// Insertar datos iniciales
include_once 'src/db/init_data.php';
try {
    if ($_GET['init'] ?? false) {
        insertInitialData($conn);
        $alert = ['type' => 'success', 'message' => 'Tablas creadas e inicializadas correctamente!'];
    } else {
        $alert = ['type' => 'info', 'message' => 'Sistema cargado.'];
    }
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}

include_once 'src/components/alert.php';
include_once 'src/components/header.php';
include_once 'src/helpers/renderQueryTable.php';
include_once 'src/components/footer.php';

renderHeader();
=======
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
>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5
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

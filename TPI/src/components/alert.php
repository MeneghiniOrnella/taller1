<?php
$alertType = null;
$message = null;

if (isset($_GET['success'])) {
    $isSuccess = $_GET['success'] == 1;
    $alertType = $isSuccess ? 'success' : 'error';
    $message = $isSuccess
        ? '✅ Solicitud exitosa.'
        : '❌ Error al procesar la solicitud.';
}

if (isset($alert) && is_array($alert)) {
    $alertType = $alert['type'] ?? 'success';
    $message = $alert['message'] ?? '';
}

if (!$alertType || !$message) return;

$bgColor = $alertType === 'success' ? 'bg-green-500' : 'bg-red-500';
$textColor = 'text-white';
$borderColor = $alertType === 'success' ? 'border-green-600' : 'border-red-600';
?>

<div class="max-w-3xl mx-auto mt-4 px-4">
    <div class="relative <?= "$bgColor $textColor $borderColor" ?> border rounded-lg px-6 py-4 font-semibold shadow-sm text-sm flex justify-between items-start" role="alert" id="alert-box">
        <span><?= htmlspecialchars($message) ?></span>
        <button 
            onclick="document.getElementById('alert-box').remove()" 
            class="ml-4 text-white text-lg leading-none hover:text-gray-200 focus:outline-none transition"
            aria-label="Cerrar alerta"
        >
            &times;
        </button>
    </div>
</div>

<?php
// manera de usar
// header("Location: index.php?success=1");
// exit;
// o sino
// $alert = [
//     'type' => 'success', // o 'error'
//     'message' => '✅ Tablas creadas e inicializadas correctamente.'
// ];
// include_once 'src/components/alert.php'
?>
<?php if (isset($_GET['success'])):
    $isSuccess = $_GET['success'] == 1;
    $bgColor = $isSuccess ? 'bg-green-500' : 'bg-red-500';
    $textColor = 'text-white';
    $borderColor = $isSuccess ? 'border-green-600' : 'border-red-600';
    $message = $isSuccess ? '✅ Solicitud exitosa.' : '❌ Error al procesar la solicitud.';
?>
<div class="max-w-3xl mx-auto mt-4 px-4">
    <div class="relative <?= "$bgColor $textColor $borderColor" ?> border rounded-lg px-6 py-4 font-semibold shadow-sm text-sm flex justify-between items-start" role="alert" id="alert-box">
        <span><?= $message ?></span>
        <button 
            onclick="document.getElementById('alert-box').remove()" 
            class="ml-4 text-white text-lg leading-none hover:text-gray-200 focus:outline-none transition"
            aria-label="Cerrar alerta"
        >
            &times;
        </button>
    </div>
</div>
<?php endif; ?>

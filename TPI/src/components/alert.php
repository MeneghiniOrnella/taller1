<?php
function renderAlert(string $type, string $message): void {
    $colors = [
        'success' => 'green',
        'error' => 'red'
    ];
    $color = $colors[$type] ?? 'blue';

    echo "
    <div class='max-w-3xl mx-auto mt-4 px-4'>
        <div class='border rounded-lg bg-{$color}-400 border-{$color}-500 text-{$color}-900 px-6 py-4 font-mono shadow-sm text-sm flex justify-between items-start' role='alert' id='alert-box'>
            <span>$message</span>
            <button 
                onclick='document.getElementById('alert-box').remove()' 
                class='ml-4 text-{$color}-900 text-lg leading-none hover:text-gray-200 focus:outline-none transition'
                aria-label='Cerrar alerta'
            >
                &times;
            </button>
        </div>
    </div>";
}
?>
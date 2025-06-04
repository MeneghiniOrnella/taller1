<?php
function renderAlert(string $type, string $message): void {
    $colors = [
        'success' => 'green',
        'error' => 'red',
        'info' => 'blue'
    ];
    $color = $colors[$type] ?? 'gray';

    echo "<div class='mb-4 p-4 border-l-4 border-{$color}-500 bg-{$color}-100 text-{$color}-800 rounded'>
            $message
          </div>";
}
?>
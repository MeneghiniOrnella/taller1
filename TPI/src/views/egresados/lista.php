<?php
include_once(__DIR__ . '/../../components/table.php');

if (!empty($egresados) && is_array($egresados)) {
    $headers = ['Nombre', 'Estado'];
    $rows = array_map(function ($e) {
        return [$e['nombre'], $e['estado']];
    }, $egresados);

    renderTable($headers, $rows);
} else if(!empty($formData['useAlerts'])) {
    include('alert.php');
}
?>
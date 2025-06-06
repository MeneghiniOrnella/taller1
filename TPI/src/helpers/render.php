<?php
// function renderPage($viewPath, $data = []) {
    // extract($data);
    // $viewPath = __DIR__ . '/../../' . $viewPath;
    // $layoutPath = __DIR__ . '/../layouts/layout.php';

    // include($layoutPath);
// }
function renderQueryTable($query, $headers, $conn) {
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $rows[] = array_values($row);
    }

    renderTable($headers, $rows);
}
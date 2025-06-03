<?php
function renderPage($viewPath, $data = []) {
    extract($data);
    $viewPath = __DIR__ . '/../../' . $viewPath;
    $layoutPath = __DIR__ . '/../layouts/layout.php';

    include($layoutPath);
}
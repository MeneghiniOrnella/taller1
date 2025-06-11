<?php include "src/components/header.php"; ?>
    <h1>Lista de egresados</h1>
<?php
// http://localhost/taller1/TPI/index.php

$components = ["header", "modal", "table", "alert", "footer"];

foreach ($components as $component) {
    include "src/components/{$component}.php";
}
?>

<!-- http://localhost/taller1/TPI/public/index.php -->

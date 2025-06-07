<?php
renderQueryTable(
    $conn,
    "SELECT id, nombre FROM carreras",
    ['Nombre'],
    function($row) {
        return [$row['nombre']];
    }
);
?>
<?php
renderQueryTable(
    $conn,
    "SELECT id, nombre FROM carreras",
    ['ID', 'Nombre', 'Acciones'],
    function($row) {
        return [$row['id'], $row['nombre'], 'no implementado'];
    }
);
?>
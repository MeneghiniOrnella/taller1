<?php
renderQueryTable(
    $conn,
    "SELECT id, email FROM emails_admin",
    ['ID', 'Email', 'Acciones'],
    function($row) {
        return [$row['id'], $row['email'], 'no implementado'];
    }
);
?>
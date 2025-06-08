<?php
renderQueryTable(
    $conn,
    "SELECT id, email FROM emails_admin",
    ['id', 'Email'],
    function($row) {
        return [$row['id'], $row['email']];
    }
);
?>
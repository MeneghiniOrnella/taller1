<?php
renderQueryTable(
    $conn,
    "SELECT id, email FROM emails_admin",
    ['Email'],
    function($row) {
        return [$row['email']];
    }
);
?>
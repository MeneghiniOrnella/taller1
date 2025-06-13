<?php
renderQueryTable(
    $conn,
    "SELECT id, usuario, password FROM admins",
    ['Usuario', 'Contraseña'],
    'Listado de Administradores',
    function($row) {
        return [$row['usuario'], $row['password']];
    }
);
?>
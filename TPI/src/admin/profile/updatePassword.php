<?php
session_start();
include('../utils/db.php');
include('helpers/handle_redirect.php');
include('helpers/validate_fields.php');




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin_id'])) {
    $adminId = $_SESSION['admin_id'];
    $datos = validateFields(['actual', 'nueva', 'confirmar'], $_POST);

    if ($datos['nueva'] !== $datos['confirmar']) {
        redirectWith('../../admin/cambiar_password.php', 'error', 1);
    }

    $res = mysqli_query($conn, "SELECT password FROM admins WHERE id = $adminId");
    $row = mysqli_fetch_assoc($res);

    if ($row && $row['password'] === $datos['actual']) {
        $stmt = mysqli_prepare($conn, "UPDATE admins SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'si', $datos['nueva'], $adminId);
        mysqli_stmt_execute($stmt) ? 
            redirectWith('../../admin/cambiar_password.php', 'success', 1) :
            redirectWith('../../admin/cambiar_password.php', 'error', 2);
    } else {
        redirectWith('../../admin/cambiar_password.php', 'error', 3);
    }
}

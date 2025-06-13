<?php
function loginRow(mysqli $conn, string $usuario, string $password): ?array
{
    $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin["password"])) {
        return $admin;
    }
    return null;
}
?>
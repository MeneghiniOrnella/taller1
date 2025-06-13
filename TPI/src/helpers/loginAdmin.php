<?php
function loginAdmin($conn, $usuario, $password) {
    $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row["password"] === $password) {
            return $row;
        }
    }

    return false;
}

<?php

function deleteRow(mysqli $conn, string $table, int $id, string $campoId = "id")
{
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        echo "<p class='text-red-600'>Nombre de tabla inválido.</p>";
        return;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM `$table` WHERE `$campoId` = ?");
    if (!$stmt) {
        $alert = [
            "type" => "error",
            "message" => "Error al preparar la consulta: " . mysqli_error($conn),
        ];
        return;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $alert = ["type" => "success", "message" => "Registro eliminado correctamente."];
        return;
    } else {
        $alert = ["type" => "success", "message" => "No se encontró el registro con ID = $id."];
    }

    mysqli_stmt_close($stmt);
}
?>

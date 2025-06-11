<?php
function deleteRow(mysqli $conn, string $table, int $id, string $campoId = "id")
{
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        echo "<p class='text-red-600'>Nombre de tabla inválido.</p>";
        return;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM `$table` WHERE `$campoId` = ?");
    if (!$stmt) {
        echo "<p class='text-red-600'>Error al preparar la consulta: " .
            mysqli_error($conn) .
            "</p>";
        return;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<p class='text-green-600'>Registro eliminado correctamente.</p>";
    } else {
        echo "<p class='text-yellow-600'>No se encontró el registro con ID = $id.</p>";
    }

    mysqli_stmt_close($stmt);
}
?>

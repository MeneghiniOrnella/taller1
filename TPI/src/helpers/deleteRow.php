<?php
function deleteRow($conn, string $table, string $campoId = 'id', $id = null) {
    if ($id !== null) {
        $id = intval($id);

        $sql = "DELETE FROM `$table` WHERE `$campoId` = $id";
        $res = mysqli_query($conn, $sql);

        if (!$res) {
            echo "<p class='text-red-600'>Error al ejecutar DELETE: " . mysqli_error($conn) . "</p>";
        } else {
            if (mysqli_affected_rows($conn) === 0) {
                echo "<p class='text-yellow-600'>No se encontró ningún registro con ID = $id</p>";
            } else {
                echo "<p class='text-green-600'>Registro con ID = $id eliminado correctamente.</p>";
                // Redirigir evitando reenvío del formulario
                // header("Location: " . strtok($_SERVER["REQUEST_URI"], '?') . "?tabla=$table");
                // exit;
            }
        }
    }
}
?>

<?php
function updateRow($conn, string $table, array $data, string $campoId = "id", $id = null)
{
    if ($id === null) {
        echo "<p class='text-red-600'>ID no proporcionado para la actualización.</p>";
        return;
    }

    if (empty($data)) {
        echo "<p class='text-yellow-600'>No hay datos para actualizar.</p>";
        return;
    }

    $id = intval($id);

    $setParts = [];
    foreach ($data as $campo => $valor) {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $campo)) {
            echo "<p class='text-red-600'>Campo inválido: $campo</p>";
            return;
        }

        $valorEscapado = mysqli_real_escape_string($conn, (string) $valor);
        $setParts[] = "`$campo` = '$valorEscapado'";
    }

    $setString = implode(", ", $setParts);
    $sql = "UPDATE `$table` SET $setString WHERE `$campoId` = $id";

    $res = mysqli_query($conn, $sql);

    if (!$res) {
        $alert = ["type" => "success", "message" => "Error al ejecutar UPDATE: " . mysqli_error($conn)];
    } else {
        if (mysqli_affected_rows($conn) === 0) {
            $alert = ["type" => "success", "message" => "No se modificó ningún registro con ID = $id (puede que no exista o los datos sean idénticos)."];
        } else {
            $alert = ["type" => "success", "message" => "Registro con ID = $id actualizado correctamente."];
        }
    }
}
?>

<?php
function updateRow(
    mysqli $conn,
    string $table,
    array $data,
    string $campoId = "id",
    $id = null
): void {
    global $alert;

    if ($id === null) {
        $alert = ["type" => "error", "message" => "ID no proporcionado para la actualización."];
        return;
    }

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        $alert = ["type" => "error", "message" => "Nombre de tabla inválido."];
        return;
    }

    $excludedKeys = ["tabla", "update_id", "submit"];
    foreach ($excludedKeys as $key) {
        unset($data[$key]);
    }

    if (empty($data)) {
        $alert = ["type" => "error", "message" => "No hay datos válidos para actualizar."];
        return;
    }

    $id = intval($id);
    $setParts = [];

    foreach ($data as $campo => $valor) {
        if (!preg_match('/^[a-zA-Z0-9_@]+$/', $campo)) {
            $alert = ["type" => "error", "message" => "Campo inválido: $campo"];
            return;
        }

        $valorEscapado = mysqli_real_escape_string($conn, (string) $valor);
        $setParts[] = "`$campo` = '$valorEscapado'";
    }

    $setString = implode(", ", $setParts);
    $sql = "UPDATE `$table` SET $setString WHERE `$campoId` = $id";

    $res = mysqli_query($conn, $sql);

    if (!$res) {
        $alert = [
            "type" => "error",
            "message" => "Error al ejecutar UPDATE: " . mysqli_error($conn),
        ];
    } else {
        if (mysqli_affected_rows($conn) === 0) {
            $alert = [
                "type" => "warning",
                "message" => "No se modificó ningún registro con ID = $id (puede que no exista o los datos sean idénticos).",
            ];
        } else {
            $alert = [
                "type" => "success",
                "message" => "Registro con ID = $id actualizado correctamente.",
            ];
        }
    }
}
?>
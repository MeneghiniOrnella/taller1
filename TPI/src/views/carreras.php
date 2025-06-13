<?php
global $conn;
$editData = null;

if (isset($_GET["edit_id"])) {
    $editId = intval($_GET["edit_id"]);
    $query = "SELECT * FROM carreras WHERE id = $editId";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $editData = mysqli_fetch_assoc($result);
    }
}

renderForm([
    "action" => "dashboard.php?tabla=carreras",
    "method" => "post",
    "title" => $editData ? "Editar carrera seleccionada" : "Agregar nueva carrera",
    "submit" => $editData ? "Actualizar" : "Agregar",
    "fields" => array_merge(
        $editData ? [["name" => "update_id", "type" => "hidden", "value" => $editData["id"]]] : [],
        [
            ["name" => "tabla", "type" => "hidden", "value" => "carreras"],
            [
                "name" => "nombre",
                "label" => "Nombre de la carrera",
                "required" => true,
                "value" => $editData["nombre"] ?? "",
            ],
        ]
    ),
]);

renderQueryTable(
    $conn,
    "SELECT a.id, a.nombre 
    FROM carreras a",
    ["id", "Carrera"],
    function ($row) {
        return [$row["id"], $row["nombre"]];
    },
    "carreras"
);
?>

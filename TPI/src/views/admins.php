<?php
global $conn;
$editData = null;

if (isset($_GET["edit_id"])) {
    $editId = intval($_GET["edit_id"]);
    $query = "SELECT * FROM admins WHERE id = $editId";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $editData = mysqli_fetch_assoc($result);
    }
}

renderForm([
    "action" => "dashboard.php?tabla=admins",
    "method" => "post",
    "title" => $editData ? "Editar usuario administrador" : "Agregar nuevo usuario administrador",
    "submit" => $editData ? "Actualizar" : "Agregar",
    "fields" => array_merge(
        $editData ? [["name" => "update_id", "type" => "hidden", "value" => $editData["id"]]] : [],
        [
            ["name" => "tabla", "type" => "hidden", "value" => "admins"],
            [
                "name" => "usuario",
                "label" => "Usuario",
                "required" => true,
                "value" => $editData["usuario"] ?? "",
            ],
            [
                "name" => "password",
                "label" => "Contraseña",
                "required" => !$editData,
                "value" => "",
            ],
        ]
    ),
]);

renderQueryTable(
    $conn,
    "SELECT id, usuario, password FROM admins",
    ["Usuario", "Contraseña"],
    function ($row) {
        return [$row["usuario"], $row["password"]];
    },
    "admins"
);
?>
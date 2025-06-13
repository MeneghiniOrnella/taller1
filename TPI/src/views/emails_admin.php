<?php
global $conn;

$editData = null;

if (isset($_GET["edit_id"])) {
    $editId = intval($_GET["edit_id"]);
    $result = mysqli_query($conn, "SELECT * FROM emails_admin WHERE id = $editId");
    if ($result && mysqli_num_rows($result) > 0) {
        $editData = mysqli_fetch_assoc($result);
    }
}

renderForm([
    "action" => "dashboard.php?tabla=emails_admin",
    "method" => "post",
    "title" => $editData ? "Editar email" : "Agregar email",
    "submit" => $editData ? "Actualizar" : "Agregar",
    "fields" => array_merge(
        $editData ? [["name" => "update_id", "type" => "hidden", "value" => $editData["id"]]] : [],
        [
            ["name" => "tabla", "type" => "hidden", "value" => "emails_admin"],
            [
                "name" => "email",
                "label" => "Email",
                "type" => "email",
                "required" => true,
                "value" => $editData["email"] ?? "",
            ],
        ]
    ),
]);

renderQueryTable(
    $conn,
    "SELECT id, email FROM emails_admin",
    ["ID", "Email"],
    function ($row) {
        return [$row["id"], $row["email"]];
    },
    "emails_admin"
);
?>
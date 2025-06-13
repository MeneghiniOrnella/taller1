<?php
global $conn;
$editData = null;

if (isset($_GET["edit_id"])) {
    $editId = intval($_GET["edit_id"]);
    $query = "SELECT * FROM egresados WHERE id = $editId";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $editData = mysqli_fetch_assoc($result);
    }
}

renderForm([
    "action" => "dashboard.php?tabla=egresados",
    "method" => "post",
    "title" => $editData ? "Editar egresado" : "Agregar nuevo egresado",
    "submit" => $editData ? "Actualizar" : "Agregar",
    "fields" => array_merge(
        $editData ? [["name" => "update_id", "type" => "hidden", "value" => $editData["id"]]] : [],
        [
            ["name" => "tabla", "type" => "hidden", "value" => "egresados"],
            [
                "name" => "nombre",
                "label" => "Nombre",
                "required" => true,
                "value" => $editData["nombre"] ?? "",
            ],
            [
                "name" => "apellido",
                "label" => "Apellido",
                "required" => true,
                "value" => $editData["apellido"] ?? "",
            ],
            [
                "name" => "matricula",
                "label" => "Matrícula",
                "type" => "number",
                "required" => true,
                "value" => $editData["matricula"] ?? "",
            ],
            [
                "name" => "email",
                "label" => "Email",
                "type" => "email",
                "required" => true,
                "value" => $editData["email"] ?? "",
            ],
            [
                "name" => "telefono",
                "label" => "Teléfono",
                "type" => "text",
                "value" => $editData["telefono"] ?? "",
            ],
            [
                "name" => "carrera_id",
                "label" => "Carrera ID",
                "type" => "number",
                "required" => true,
                "value" => $editData["carrera_id"] ?? "",
            ],
            [
                "name" => "estado",
                "label" => "Estado",
                "required" => false,
                "value" => $editData["estado"] ?? "",
            ],
        ]
    ),
]);

renderQueryTable(
    $conn,
    "SELECT e.id, e.nombre, e.apellido, e.matricula, e.email, e.telefono, c.nombre AS carrera, e.estado
    FROM egresados e
    JOIN carreras c ON e.carrera_id = c.id",
<<<<<<< HEAD
    ['Id', 'Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono', 'Carrera', 'Estado'],
    'Listado de Egresados',
    function($row) {
        return [$row['id'], $row['nombre'], $row['apellido'], $row['matricula'], $row['email'], $row['telefono'], $row['carrera'], $row['estado']];
=======
    ["Id", "Nombre", "Apellido", "Matrícula", "Email", "Teléfono", "Carrera", "Estado"],
    function ($row) {
        return [
            $row["id"],
            $row["nombre"],
            $row["apellido"],
            $row["matricula"],
            $row["email"],
            $row["telefono"],
            $row["carrera"],
            $row["estado"],
        ];
>>>>>>> 59f8c15eacf699888ca9715918e9b23cd7ada9b5
    },
    "egresados"
);
?>

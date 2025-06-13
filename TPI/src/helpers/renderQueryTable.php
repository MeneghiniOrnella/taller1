<?php
include_once __DIR__ . "/../components/table.php";

function renderQueryTable($conn, $query, $headers, $rowFormatter = null, $table)
{
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $rows[] = $rowFormatter ? $rowFormatter($row) : array_values($row);
    }

    $bloqueados = [];
    if ($table === "carreras") {
        $bloqRes = mysqli_query($conn, "SELECT DISTINCT carrera_id FROM egresados");
        while ($bloq = mysqli_fetch_assoc($bloqRes)) {
            $bloqueados[] = $bloq["carrera_id"];
        }
    }

    renderTable($headers, $rows, $table, $bloqueados);
}

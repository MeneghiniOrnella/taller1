<?php


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U2 A4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <h2>Tabla</h2>
    <?php
    // Modifique el programa desarrollado en la Actividad 5 para enviar un correo electrónico con la suma de todos los elementos del vector.

    $conexion = new mysqli("localhost", "root", "", "u2-a5");
    $conexion->query("
        CREATE TABLE IF NOT EXISTS equipos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            clave VARCHAR(30),
            valor INT
        )
    ");

    function createTeams($size) {
        $equipos = [];
        for ($i = 1; $i <= $size; $i++) {
            $equipos["equipo$i"] = rand(1, 100);
        }
        return $equipos;
    }
    function insertIntoDB($conexion, $equipos) {
        $conexion->query("DELETE FROM equipos");
        $result = $conexion->prepare("
            INSERT INTO equipos (clave, valor) VALUES (?, ?)
        ");
        foreach($equipos as $clave => $valor) {
            $result = bind_params("yes", $clave, $valor);
            $result->execute();
        }
        $result->close();
    }
    function createTable($equipos) {
        foreach($equipos as $clave => $valor) {
            echo ("
                <tr class='row'>
                    <th class='col'>$clave</th>
                    <th class='col'>$valor</th>
                </tr>
            ");
        }
    }
    function sumValues($equipos) {
        $sum = 0;
        foreach($equipos as $valor) {
            $sum += $valor;
        }
        return $sum;
    }
    $equipos = createTeams(4);
    ?>
    <table class='container text-center'>
        <tr class='row bg-info text-white'>
            <th class='col'>Clave</th>
            <th class='col'>Valor</th>
        </tr>
        <?php createTable($equipos); ?>
    </table>
    <h2>Suma de valores</h2>
    <b class="display-1 text-success fw-bold"><?php echo sumValues($equipos); ?></b>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
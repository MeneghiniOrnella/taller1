<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U2 A4</title>
</head>
<body>
    <h2>Tabla</h2>
    <?php
<?php
    // Modifique el programa desarrollado en la Actividad 4 para almacenar los datos del array en una tabla en una base de datos MySQL.
    function createTeams($size) {
        $equipos = [];
        for ($i = 1; $i <= $size; $i++) {
            $equipos["equipo$i"] = rand(1, 100);
        }
        return $equipos;
    }
    function createTable($equipos) {
        foreach($equipos as $clave => $valor) {
            echo ("
                <tr>
                    <th>$clave</th>
                    <th>$valor</th>
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
    <table>
        <tr>
            <th>Clave</th>
            <th>Valor</th>
        </tr>
        <?php createTable($equipos); ?>
    </table>
    <h2>Suma de valores</h2>
    <b><?php echo sumValues($equipos); ?></b>
</body>
</html>
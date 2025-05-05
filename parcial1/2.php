<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcial 1</title>
</head>
<style>
    th,
    td {
        border: 1px solid black;
        text-align: center;
    }
</style>
<body>
    <h1>Parcial 1</h1>

    <?php
    $tabla = [
        "2020" => [
            "1T" => 120,
            "2T" => 125,
            "3T" => 135,
            "4T" => 119
        ],
        "2021" => [
            "1T" => 90,
            "2T" => 85,
            "3T" => 125,
            "4T" => 125
        ],
        "2022" => [
            "1T" => 110,
            "2T" => 100,
            "3T" => 105,
            "4T" => 115
        ]
    ];
    $totalTrimestre = [
        "1T" => 0,
        "2T" => 0,
        "3T" => 0,
        "4T" => 0
    ];
    ?>

    <table>
        <thead>
            <tr>
                <th>Año</th>
                <th>1º Trimestre</th>
                <th>2º Trimestre</th>
                <th>3º Trimestre</th>
                <th>4º Trimestre</th>
                <th>Total Anual</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tabla as $anio => $trimestres): ?>
                <tr>
                    <td><?php echo $anio; ?></td>
                    <?php
                        $totalA = 0;
                        foreach (["1T", "2T", "3T", "4T"] as $t) {
                            echo "<td>{$trimestres[$t]}</td>";
                            $totalA += $trimestres[$t];
                            $totalTrimestre[$t] += $trimestres[$t];
                        }
                    ?>
                    <td><b><?php echo $totalA; ?></b></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th>Total</th>
                <?php
                foreach ($totalTrimestre as $totalT) {
                    echo "<td><b>{ $totalT }</b></td>";
                }
                ?>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
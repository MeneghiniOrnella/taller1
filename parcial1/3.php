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
    $f = 0;
    $inicial = -10;
    $final = 20;
    $incremento = 10;

    function convertiraF($c) {
        $f = ($c*(9/5))+32;
        return $f;
    }

    ?>

    <table>
        <thead>
            <tr>
                <th>Celcius</th>
                <th>Fahrenheit</th>
            </tr>
        </thead>
        <tbody>
            <?php for($c = $inicial; $c <= $final; $c += $incremento): ?>
                <tr>
                    <td>
                        <?php echo $c; ?>
                    </td>
                    <td>
                        <?php echo convertiraF($c); ?>
                    </td>
                </tr>
            <?php endfor; ?>
            </tr>
        </tbody>
    </table>
</body>
</html>
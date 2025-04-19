<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U2 A3</title>
</head>
<body>
    <h2>Tabla</h2>
    <?php
    // Desarrolle un programa que complete con números al azar los elementos de un array asociativo con las siguientes claves: equipo1, equipo2, equipo3, equipo4.
    // El programa debe mostrar, utilizando PHP y HTML, una tabla con la clave y el valor de cada elemento. Luego de la tabla, deberá mostrar la suma de todos los valores.
    $equipos = [
        "equipo1" => rand(1,100),
        "equipo2" => rand(1,100),
        "equipo3" => rand(1,100),
        "equipo4" => rand(1,100)
    ];
    $sum = 0;
    ?>
    <table>
        <tr>
            <th>Clave</th>
            <th>Valor</th>
        </tr>
        <?php foreach($equipos as $clave => $valor) { ?>
        <tr>
            <th><?php echo $clave; ?></th>
            <th><?php echo $valor; ?></th>
        </tr>
        <?php
            $sum += $valor;
        } ?>
    </table>
    
    <h2>Suma de valores</h2>
    <b><?php echo $sum; ?></b>
</body>
</html>
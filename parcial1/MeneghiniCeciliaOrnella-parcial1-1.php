<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcial 1</title>
</head>
<body>
<?php
// Desarrollar una función en PHP que reciba como parámetros un arreglo de números y un número entero. La función debe devolver la cantidad de elementos que son divisibles por el número proporcionado. Ejemplo: Dado el arreglo [12, 15, 9, 20, 25] y el número 5, la función debe devolver 3, ya que los números divisibles por 5 son 15, 20, y 25.
// http://localhost/taller1/parcial1/MeneghiniCeciliaOrnella-parcial1-1.php 

$numIngresados = [];
$divisor = 0;
$resultado = 0;
$divisibles = [];

function contarDivisibles($numIngresados, $divisor) {
    foreach($numIngresados as $numIngresado) {
        if(($num % $divisor) === 0 && $divisor != 0) {
            $resultado = $resultado +1;
        }
    }
    return $resultado;
}

if (isset($_GET['array']) && isset($_GET['divisor'])) {
    $entrada = $_GET['array'];
    $divisor = intval($_GET['divisor']);
    $elementos = explode(",", $entrada);

    foreach ($elementos as $valor) {
        $valor = trim($valor);
        if (is_numeric($valor)) {
            $num = intval($valor);
            $numIngresados[] = $num;
            if ($divisor != 0 && $num % $divisor === 0) {
                $divisibles[] = $num;
            }
        }
    }

    $resultado = contarDivisibles($numIngresados, $divisor);
}

?>
    <h1>Parcial 1</h1>
    <form action="" method="get">
        <label for="array">Ingresar numero del array, separados entre comas</label>
        <input type="text" name="array" id="array">
        <label for="divisor">Ingresar numero entero</label>
        <input type="number" name="divisor" id="divisor">
        <button type="submit">Chequear</button>
    </form>
    <?php if(<?php if(isset($_GET['array']) && isset($_GET['divisor']) && $_GET['array'] !== '' && $_GET['divisor'] !== '')) { ?>
    <div class="rta">
        <p>
        Dado el arreglo [
        <?php
        foreach ($numIngresados as $i => $valor) {
            echo $valor;
            if ($i < count($numIngresados) - 1) {
                echo ", ";
            }
        }
        ?>
        ] y el número <?php echo $divisor; ?>, la función debe devolver <b><?php echo $resultado; ?></b>,
        ya que los números divisibles por <?php echo $divisor; ?> son 
        <?php
        foreach ($divisibles as $i => $valor) {
            echo $valor;
            if ($i < count($divisibles) - 1) {
                echo ", ";
            }
        }
        ?>.
    </p>

    </div>
    <?php } ?>
</body>
</html>
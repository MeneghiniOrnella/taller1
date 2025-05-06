<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcial 1</title>
</head>
<body>
    <h1>Parcial 1</h1>

<?php
$numIngresados = [];
$divisor = 0;
$divisibles = [];
$resultado = 0;

function contarDivisibles($numIngresados, $divisor) {
    $resultado = 0;
    foreach($numIngresados as $numIngresado) {
        if($numIngresado % $divisor === 0 && $divisor != 0) {
            $resultado++;
        }
    }
    return $resultado;
}

if (isset($_GET['array']) && isset($_GET['divisor']) && $_GET['array'] !== '' && $_GET['divisor'] !== '') {
    $entrada = $_GET['array'];
    $divisor = $_GET['divisor'];
    $elementos = explode(",", $entrada);

    foreach ($elementos as $valor) {
        $valor = trim($valor);
        if (i$valor) {
            $num =$valor;
            $numIngresados[] = $num;
            if ($divisor != 0 && $num % $divisor === 0) {
                $divisibles[] = $num;
            }
        }
    }

    $resultado = contarDivisibles($numIngresados, $divisor);
}
?>

<form action="" method="get">
    <label for="array">Ingresar números del array, separados por comas</label>
    <input type="text" name="array" id="array" value="<?php echo isset($_GET['array']) ? $_GET['array'] : ''; ?>">
    <label for="divisor">Ingresar numero entero</label>
    <input type="number" name="divisor" id="divisor" value="<?php echo isset($_GET['divisor']) ? $_GET['divisor'] : ''; ?>">
    <button type="submit" name="watchText">Chequear</button>
</form>
<br/>

<?php if(isset($_GET['watchText']) &&
    isset($_GET['array'], $_GET['divisor']) &&
    $_GET['array'] !== '' &&
    is_numeric($_GET['divisor']) &&
    $_GET['divisor'] != 0) { ?>
    <div class="rta">
        <b><?php echo $resultado; ?></b>
        <p>
            Dado el arreglo [<?php
            foreach ($numIngresados as $i => $valor) {
                echo $valor;
                if ($i < count($numIngresados) - 1) {
                    echo ", ";
                }
            }
            ?>] y el número <?php echo $divisor; ?>, la función debe devolver <b><?php echo $resultado; ?></b>,
            ya que los números divisibles por <?php echo $divisor; ?> son <?php
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
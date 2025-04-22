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
    // Modifique el programa desarrollado en la Actividad 5 para enviar un correo electrónico con la suma de todos los elementos del vector.

    function connectDB() {
        $connection = new mysqli("localhost", "root", "", "u2-a5");
        if ($connection->connect_error) {
            die("Error de Conexión: ".$connection->connect_error);
        }
        return $connection;
    }

    function createTable($connection) {
        $connection->query("CREATE TABLE IF NOT EXISTS equipos (id INT AUTO_INCREMENT PRIMARY KEY, clave VARCHAR(30), valor INT)");
    }

    function deleteTable($connection) {
        $connection->query("DELETE FROM equipos");
    }

    function createTeams($size) {
        $equipos = [];
        for ($i = 1; $i <= $size; $i++) {
            $equipos["equipo$i"] = rand(1, 100);
        }
        return $equipos;
    }

    function saveOnDB($connection, $equipos) {
        $connection->query("DELETE FROM equipos");
        foreach($equipos as $clave => $valor) {
            $connection->query("INSERT INTO equipos (clave, valor) VALUES ('$clave', $valor)");
        }
    }

    function showTable($equipos) {
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

    $connection = connectDB();
    createTable($connection);
    $equipos = createTeams(4);
    saveOnDB($connection, $equipos);

    ?>
    <table>
        <tr>
            <th>Clave</th>
            <th>Valor</th>
        </tr>
        <?php showTable($equipos); ?>
    </table>
    <h2>Suma de valores</h2>
    <b><?php echo sumValues($equipos); ?></b>
</body>
</html>
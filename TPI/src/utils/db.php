<?php
function connectDB()    {
    $connection = mysqli_connect("localhost", "root", "", "taller1-tpi");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
}
function createTableEgresados($connection) {
    $query = "CREATE TABLE IF NOT EXISTS egresados (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(30) NOT NULL,
        matricula INT NOT NULL,
        email VARCHAR(50) NOT NULL,
        telefono INT NOT NULL
    )";
    if (!mysqli_query($connection, $query)) {
        die("Error creating table: " . mysqli_error($connection));
    }
}
function deleteTableEgresados($connection) {
    $connection->query("DELETE FROM egresados");
}
function createEgresados($size) {
    $egresados = [];
    for ($i = 1; $i <= $size; $i++) {
        $egresados[] = [
            'nombre' => "Nombre$i",
            'apellido' => "Apellido$i",
            'matricula' => rand(1000, 9999),
            'email' => "",
            'telefono' => rand(1000000000, 9999999999)
        ];
    }
    return $egresados;
}
function saveEgresadoOnDB($connection, $egresados) {
    $connection->query("DELETE FROM egresados");
    foreach($egresados as $egresado) {
        $stmt = mysqli_prepare($connection, "INSERT INTO egresados (nombre, apellido, matricula, email, telefono) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssiss', $egresado['nombre'], $egresado['apellido'], $egresado['matricula'], $egresado['email'], $egresado['telefono']);
        mysqli_stmt_execute($stmt);
    }
}
function showTableEgresados($connection) {
    $result = mysqli_query($connection, "SELECT * FROM egresados");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['apellido']}</td>
                    <td>{$row['matricula']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['telefono']}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay egresados registrados.</td></tr>";
    }
}
function sendEmailWithNewEgresado($email, $subject, $message, $to, $headers) {
    if (mail($to, $subject, $message, $headers)) {
        echo "Email enviado correctamente a $to.";
    } else {
        echo "Error al enviar el email.";
    }
}

$connection = connectDB();
createTableEgresados($connection);
deleteTableEgresados($connection);
$egresados = createEgresados(4);
saveEgresadoOnDB($connection, $egresados);
sendEmailWithNewEgresado($email, $subject, $message, $to, $headers);
?>
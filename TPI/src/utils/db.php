<?php
    $egresados = [];

    // function connectDB() {
    //     $connection = mysqli_connect("localhost", "root", "", "tpi");
    //     return $connection;
    // }

    // function createTable($connection) {
    //     $connection->query("CREATE TABLE IF NOT EXISTS egresados (id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(30), apellido VARCHAR(30), carrera VARCHAR(30), matricula INT, email VARCHAR(50), telefono INT)");
    // }

    // function deleteTable($connection) {
    //     $connection->query("DELETE FROM equipos");
    // }

    // function createTeams($size) {
    //     $equipos = [];
    //     for ($i = 1; $i <= $size; $i++) {
    //         $equipos["equipo$i"] = rand(1, 100);
    //     }
    //     return $equipos;
    // }

    // function saveOnDB($connection, $equipos) {
    //     $connection->query("DELETE FROM equipos");
    //     foreach($equipos as $clave => $valor) {
    //         $connection->query("INSERT INTO equipos (clave, valor) VALUES ('$clave', $valor)");
    //     }
    // }

    // function showTable($equipos) {
    //     foreach($equipos as $clave => $valor) {
    //         echo ("
    //             <tr>
    //                 <th>$clave</th>
    //                 <th>$valor</th>
    //             </tr>
    //         ");
    //     }
    // }

    // function sumValues($equipos) {
    //     $sum = 0;
    //     foreach($equipos as $valor) {
    //         $sum += $valor;
    //     }
    //     return $sum;
    // }

    // function sendEmail($sum) {
    //     $destinatario = "abc@gmail.com";
    //     $asunto = "abc";
    //     $mensaje = "abc";
    //     $cabeceras = "From: abc@gmail.com"."\r\n"."X-Mailer: PHP/".phpversion();
    //     mail($destinatario, $asunto, $mensaje,$cabeceras);
    // }

    // $connection = connectDB();
    // createTable($connection);
    // $equipos = createTeams(4);
    // saveOnDB($connection, $equipos);
    // sendEmail(sumValues($equipos));
?>
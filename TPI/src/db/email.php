<?php
function sendEmailToAdmins(mysqli $conn, string $nombre, string $apellido, string $email): void {
    $subject = "Nuevo egresado registrado";
    $message = "<html>
                <body>
                    <h1>Nuevo Egresado Registrado</h1>
                    <p>Nombre: $nombre $apellido</p>
                    <p>Email: $email</p>
                </body>
               </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: egrsados@facultad.com" . "\r\n";
    $result = mysqli_query($conn, "SELECT email FROM emails_admin");
    while ($row = mysqli_fetch_assoc($result)) {
        mail($row['email'], $subject, $message, $headers);
        echo("<div style='margin-bottom: 1rem;'>
                <strong>Asunto:</strong> $subject <br/>
                <strong>Mensaje:</strong> $message <br/>
                <strong>Headers:</strong><pre>$headers</pre>
                <strong>Email destino:</strong> {$row['email']} <br/>
                <hr/>
            </div>");
    }
}
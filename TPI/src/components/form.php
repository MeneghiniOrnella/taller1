<?php include('src/components/input.php');
// <form action="src/logic/process_form.php" method="post">
?>

<form action="" method="post">
    <?php
        renderInput("nombre", "Nombre", "text", true);
        renderInput("apellido", "Apellido", "text", true);
        renderInput("carrera", "Carrera", "text", true);
        renderInput("matricula", "Número de Matrícula", "number", true);
        renderInput("email", "Email", "email", true);
        renderInput("telefono", "Teléfono", "text", true);
    ?>
    <div>
        <button type="submit">Enviar</button>
    </div>
</form>

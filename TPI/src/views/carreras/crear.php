<?php
include_once('../../components/input.php');
?>

<h2>Crear Nueva Carrera</h2>

<form action="../../actions/carreras_submit.php" method="POST">
    <?php renderInput('nombre', 'Nombre de la carrera', 'text', true); ?>
    <button type="submit">Guardar</button>
</form>

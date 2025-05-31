<?php
include_once('../../components/input.php');
?>

<h2>Crear Nuevo Administrador</h2>

<form action="../../actions/admins_submit.php" method="POST">
    <?php renderInput('usuario', 'Nombre de Usuario', 'text', true); ?>
    <?php renderInput('password', 'Contraseña', 'password', true); ?>
    <button type="submit">Guardar</button>
</form>

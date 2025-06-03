<?php
include_once('components/input.php');
include_once('utils/db.php');

$conn = connectDB();

// Traer las carreras para el select
$carreras = mysqli_query($conn, "SELECT id, nombre FROM carreras");
?>

<h2>Registro de Egresados</h2>

<form action="actions/egresados_submit.php" method="POST">
    <?php renderInput('nombre', 'Nombre', 'text', true); ?>
    <?php renderInput('apellido', 'Apellido', 'text', true); ?>

    <label for="carrera">Carrera</label>
    <select name="carrera" required>
        <option value="">Seleccione</option>
        <?php while ($row = mysqli_fetch_assoc($carreras)) : ?>
            <option value="<?= $row['nombre'] ?>"><?= $row['nombre'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <?php renderInput('matricula', 'Matrícula', 'text', true); ?>
    <?php renderInput('email', 'Email', 'email', true); ?>
    <?php renderInput('telefono', 'Teléfono', 'text', true); ?>

    <button type="submit">Registrarse</button>
</form>

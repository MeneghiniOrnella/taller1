<?php
include_once('../../components/table.php');
include_once('../../utils/db.php');

$connection = connectDB();
$result = mysqli_query($connection, "SELECT id, usuario FROM admins");
?>

<h2>Listado de Administradores</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['usuario'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

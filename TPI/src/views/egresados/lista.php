<table>
    <?php foreach ($egresados as $row): ?>
        <tr>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['estado'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>


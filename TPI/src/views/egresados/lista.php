<!-- <table>
    <?php foreach ($egresados as $row): ?>
        <tr>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['estado'] ?></td>
        </tr>
    <?php endforeach; ?>
</table> -->

<?php
include_once(__DIR__ . '/../../components/table.php');

// Validar que $egresados esté definido y sea array
if (!empty($egresados) && is_array($egresados)) {
    // Crear headers desde las claves del primer egresado
    $headers = ['Nombre', 'Estado'];

    // Transformar $egresados a arreglo de arrays con valores
    $rows = array_map(function ($e) {
        return [$e['nombre'], $e['estado']];
    }, $egresados);

    renderTable($headers, $rows);
} else {
    echo "<p class='text-gray-600'>No hay egresados para mostrar.</p>";
}
?>
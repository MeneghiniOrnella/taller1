<?php
$res = mysqli_query($conn, "
    SELECT e.id, e.nombre, e.apellido, e.matricula, e.email, e.telefono, c.nombre AS carrera, e.estado
    FROM egresados e JOIN carreras c ON e.carrera_id = c.id
");

echo "<h2 class='text-xl font-semibold'>Listado de Egresados</h2>";
echo "<table border='1' cellpadding='6' class='mt-4'>";
echo "<tr>
    <th>ID</th><th>Nombre</th><th>Apellido</th><th>Matrícula</th><th>Email</th>
    <th>Teléfono</th><th>Carrera</th><th>Estado</th><th>Acciones</th>
</tr>";
while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['nombre']}</td>
        <td>{$row['apellido']}</td>
        <td>{$row['matricula']}</td>
        <td>{$row['email']}</td>
        <td>{$row['telefono']}</td>
        <td>{$row['carrera']}</td>
        <td>{$row['estado']}</td>
        <td>
            <a href='form_egresado.php?id={$row['id']}'>✏️</a> |
            <a href='delete_egresado.php?id={$row['id']}' onclick='return confirm(\"¿Eliminar?\")'>🗑️</a>
        </td>
    </tr>";
}
echo "</table>";

echo "<a class='block mt-4 text-green-600 underline' href='form_egresado.php'>➕ Nuevo Egresado</a>";

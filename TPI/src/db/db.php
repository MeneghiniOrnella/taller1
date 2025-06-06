<?php
require_once 'connect.php';
require_once 'create.php';

function mostrarEgresados(mysqli $conn): void {
    $res = mysqli_query($conn, "
        SELECT e.nombre, e.apellido, e.email, e.telefono, c.nombre AS carrera
        FROM egresados e JOIN carreras c ON e.carrera_id = c.id
    ");
    echo "<h2>Egresados cargados</h2>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Carrera</th>
            <th>Email</th>
            <th>Telefono</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido']}</td>
                <td>{$row['carrera']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telefono']}</td>
              </tr>";
    }
    echo "</table>";
}

try {
    $conn = connectDB();
    createTables($conn);
    $alert = ['type' => 'success', 'message' => 'Tablas creadas e inicializadas correctamente.'];
} catch (Exception $e) {
    $alert = ['type' => 'error', 'message' => $e->getMessage()];
}
?>

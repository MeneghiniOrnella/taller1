<?php
require_once('../utils/db.php');
require_once('../components/table.php');

// 1. Conexión
$connection = connectDB();

// 2. Función para obtener egresados
function obtenerEgresados($connection): array {
    $query = "SELECT * FROM egresados";
    $resultado = mysqli_query($connection, $query);

    $filas = [];
    while ($egresado = mysqli_fetch_assoc($resultado)) {
        $filas[] = [
            $egresado['id'],
            $egresado['nombre'],
            $egresado['apellido'],
            $egresado['matricula'],
            $egresado['email'],
            $egresado['telefono'],
            accionesHTML($egresado['id'])
        ];
    }
    return $filas;
}

// 3. Generador de acciones (reutilizable)
function accionesHTML($id): string {
    return <<<HTML
<a href="editar.php?id=$id">✏️</a>
<a href="eliminar.php?id=$id" onclick="return confirm('¿Estás seguro de eliminar este registro?')">🗑️</a>
HTML;
}

// 4. Definir columnas
$columnas = ['ID', 'Nombre', 'Apellido', 'Matrícula', 'Email', 'Teléfono', 'Acciones'];

// 5. Obtener filas y mostrar tabla
$filas = obtenerEgresados($connection);
renderTable($columnas, $filas);
?>

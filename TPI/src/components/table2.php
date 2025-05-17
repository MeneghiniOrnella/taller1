<?php
// Obtener el tipo de tabla a mostrar desde la URL
$tabla = $_GET['tabla'] ?? 'usuarios';

// Datos simulados (esto vendría de una consulta a BD)
$tablas = [
    'usuarios' => [
        ['ID' => 1, 'Nombre' => 'Ana', 'Email' => 'ana@mail.com'],
        ['ID' => 2, 'Nombre' => 'Juan', 'Email' => 'juan@mail.com']
    ],
    'productos' => [
        ['ID' => 10, 'Producto' => 'Lapicera', 'Precio' => '$1.50'],
        ['ID' => 11, 'Producto' => 'Cuaderno', 'Precio' => '$3.00']
    ]
];

// Verificamos que exista la tabla solicitada
$datos = $tablas[$tabla] ?? [];
?>
<h2 class="mb-4">Mostrando tabla: <?= htmlspecialchars($tabla) ?></h2>

<?php if (!empty($datos)): ?>
  <table class="table table-bordered">
    <thead class="bg-lila">
      <tr>
        <?php foreach (array_keys($datos[0]) as $col): ?>
          <th><?= htmlspecialchars($col) ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($datos as $fila): ?>
        <tr>
          <?php foreach ($fila as $valor): ?>
            <td><?= htmlspecialchars($valor) ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-warning">No hay datos disponibles para esta tabla.</div>
<?php endif; ?>
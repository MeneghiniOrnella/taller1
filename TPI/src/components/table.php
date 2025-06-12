<?php function renderTable($headers, $rows, $table, $bloqueados = []): void
{
    ?>
    <table class='mx-auto w-full max-w-5xl bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden'>
        <thead class='text-white text-center text-sm uppercase bg-green-500'>
            <tr class='divide-x divide-green-600'>
                <?php foreach ($headers as $header) { ?>
                    <th class='px-6 py-3 whitespace-nowrap'><?= htmlspecialchars($header) ?></th>
                <?php } ?>
                <th class='px-6 py-3 whitespace-nowrap'>Acciones</th>
            </tr>
        </thead>
        <tbody class='divide-y divide-gray-200 text-sm text-gray-700'>
            <?php foreach ($rows as $row) { ?>
                <tr class='hover:bg-blue-50 transition divide-x divide-gray-200'>
                    <?php for ($i = 0; $i < count($row); $i++) { ?>
                        <td class='px-6 py-4 capitalize'><?= htmlspecialchars($row[$i]) ?></td>
                    <?php } ?>
                    <td class='px-6 py-4 text-center space-x-2'>
                        <?php if ($table === 'carreras' && in_array($row[0], $bloqueados)): ?>
                            <button type="button" class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed" title="No se puede borrar: tiene egresados asociados" disabled>
                                Borrar
                            </button>
                            <button type="button" class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed" title="No se puede editar: tiene egresados asociados" disabled>
                                Editar
                            </button>
                        <?php else: ?>
                            <form action="" method="post" style="display:inline;" onsubmit="return confirm('¿Desea borrar este registro?');">
                                <input type="hidden" name="tabla" value="<?= htmlspecialchars($table) ?>">
                                <input type="hidden" name="delete_id" value="<?= htmlspecialchars($row[0]) ?>">
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Borrar
                                </button>
                            </form>
                            <a href="?tabla=<?= $table ?>&edit_id=<?= $row[0] ?>" 
                               class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                               Editar
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <form action="src/helpers/addRow.php" method="post" style="display:inline;" onsubmit="return confirm('¿Desea añadir un registro?');">
        <input type="hidden" name="tabla" value="<?= htmlspecialchars($table) ?>">
        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
            Añadir 1 fila al final
        </button>
    </form>
<?php
} ?>

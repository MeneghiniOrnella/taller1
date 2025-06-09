<?php function renderTable($headers, $rows, $table): void { ?>
    <script>
        function toggleAddRowForm() {
            const form = document.getElementById('addRowForm');
            form.style.display = (form.style.display === 'none') ? 'block' : 'none';
        }
    </script>

    <div id="addRowForm" class="mb-4 p-4 bg-gray-100 border rounded" style="display:none;">
    <form action="" method="post">
        <input type="hidden" name="tabla" value="<?= htmlspecialchars($table) ?>">
        <!-- Aquí agregá los campos necesarios para insertar -->
        <!-- Ejemplo de campo genérico -->
        <input type="text" name="campo1" placeholder="Valor del campo 1" required class="mb-2 p-2 border rounded w-full" />
        <!-- Repetir para cada campo necesario -->
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar fila</button>
    </form>
</div>

    <table class='mx-auto w-full max-w-5xl bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden'>
        <thead class='text-white text-center text-sm uppercase bg-green-500'>
            <tr class='divide-x divide-green-600'>
                <?php foreach($headers as $header){ ?>
                    <th class='px-6 py-3 whitespace-nowrap'><?= htmlspecialchars($header) ?></th>
                <?php } ?>
                <th class='px-6 py-3 whitespace-nowrap'>Acciones</th>
            </tr>
        </thead>
        <tbody class='divide-y divide-gray-200 text-sm text-gray-700'>
            <?php foreach($rows as $row) { ?>
                <tr class='hover:bg-blue-50 transition divide-x divide-gray-200'>
                    <?php for ($i = 0; $i < count($row); $i++) { ?>
                        <td class='px-6 py-4'><?= htmlspecialchars($row[$i]) ?></td>
                    <?php } ?>
                    <td class='px-6 py-4 text-center space-x-2'>
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
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="mt-4 text-center">
        <button onclick="toggleAddRowForm()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Añadir 1 fila al final
        </button>
    </div>
<?php } ?>

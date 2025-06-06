<?php function renderTable($headers, $rows): void { ?>
    <table class='mx-auto w-full max-w-5xl bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden'>
        <thead class='text-white text-center text-sm uppercase bg-green-500'>
            <tr class='divide-x divide-green-600'>
                <?php foreach($headers as $header){ ?>
                    <th class='px-6 py-3 whitespace-nowrap'><?= htmlspecialchars($header) ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody class='divide-y divide-gray-200 text-sm text-gray-700'>
            <?php foreach($rows as $row) { ?>
                <tr class='hover:bg-blue-50 transition divide-x divide-gray-200'>
                    <?php foreach($row as $cell){ ?>
                        <td class='px-6 py-4'><?= htmlspecialchars($cell) ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
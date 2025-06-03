<div class="overflow-x-auto mt-6 px-8">
    <table class="mx-auto w-full max-w-5xl bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="text-white text-center text-sm uppercase bg-green-500">
            <tr class="divide-x divide-green-600">
                <?php foreach($columns as $col): ?>
                    <th class="px-6 py-3 whitespace-nowrap"><?php echo $col; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
            <?php foreach($rows as $row): ?>
                <tr class="hover:bg-blue-50 transition divide-x divide-gray-200">
                    <?php foreach($row as $cell): ?>
                        <td class="px-6 py-4"><?php echo $cell; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
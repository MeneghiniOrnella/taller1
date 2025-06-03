<?php
function renderTable($headers, $rows) {
    echo "<table class='mx-auto w-full max-w-5xl bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden'>
        <thead class='text-white text-center text-sm uppercase bg-green-500'>
            <tr class='divide-x divide-green-600'>";
    foreach ($headers as $header) {
        echo "<th class='px-6 py-3 whitespace-nowrap'>$header</th>";
    }
    echo "</tr>
    </thead>
    <tbody class='divide-y divide-gray-200 text-sm text-gray-7000'>";
    foreach ($rows as $row) {
        echo "<tr class='hover:bg-blue-50 transition divide-x divide-gray-200'>";
        foreach ($row as $cell) {
            echo "<td class='px-6 py-4'>$cell</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>
    </table>";
}
?>
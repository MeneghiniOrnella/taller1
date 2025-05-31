<?php
function renderTable(array $columns, array $rows): void {
    echo '<table border="1" cellpadding="6" cellspacing="0">';
    echo '<thead><tr>';
    foreach ($columns as $col) {
        echo "<th>$col</th>";
    }
    echo '</tr></thead><tbody>';

    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo "<td>$cell</td>";
        }
        echo '</tr>';
    }

    echo '</tbody></table>';
}
?>
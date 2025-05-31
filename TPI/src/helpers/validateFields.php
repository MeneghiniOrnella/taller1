<?php
function validateFields($fields, $data) {
    $result = [];
    foreach ($fields as $field) {
        $result[$field] = trim($data[$field] ?? '');
    }
    return $result;
}
?>
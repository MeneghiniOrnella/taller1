<?php
function renderInput($id, $label, $type = 'text', $required = false) {
    $isRequired = $required ? 'required' : '';
    echo "
    <div>
        <label for='$idInput'>$labelInput</label>
        <input type='$typeInput' id='$idInput' name='$idInput' $isRequired>
    </div>
    ";
}
?>

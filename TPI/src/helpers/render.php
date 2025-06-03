<?php 
function renderInput($id, $label, $type = 'text', $required = false, $value = '') {
    $isRequired = $required ? 'required' : '';
    echo "
    <div>
        <label for='$id' class='block text-gray-700 font-semibold mb-1'>$label</label>
        <input
            type='$type'
            id='$id'
            name='$id'
            value='$value'
            $isRequired
            class='w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400'
        />
    </div>
    ";
}
?>
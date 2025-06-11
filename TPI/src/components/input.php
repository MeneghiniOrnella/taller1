<?php
function renderInput($id, $label, $type = "text", $required = false, $value = "")
{
    $isRequired = $required ? "required" : ""; ?>
    <div class="mb-4">
        <label for="<?= $id ?>" class="block text-sm font-medium mb-1 capitalize"><?= $label ?></label>
        <input
            type="<?= $type ?>"
            id="<?= $id ?>"
            name="<?= $id ?>"
            value="<?= htmlspecialchars($value) ?>"
            <?= $isRequired ?>
            class="w-full border border-gray-300 rounded-md px-3 py-2 uppercase"
        />
    </div>
<?php
}

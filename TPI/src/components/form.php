<?php
include_once __DIR__ . "/input.php";
function renderForm($formData)
{
    ?>
<div class="max-w-md mx-auto mt-6 mb-12 bg-white p-6 rounded-lg shadow-lg border border-gray-200">
    <?php if (!empty($formData["useAlerts"])) {
        include __DIR__ . "/alert.php";
    } ?>
    <form action="<?= $formData["action"] ??
        "" ?>" method="<?= $formData["method"] ?? "post" ?>" class="space-y-4">
        <h2 class="text-2xl font-semibold text-center mb-6"><?= $formData["title"] ??
            "Formulario" ?></h2>
        <?php foreach ($formData["fields"] as $field) {
            renderInput(
                $field["name"] ?? "",
                $field["label"] ?? "",
                $field["type"] ?? "text",
                $field["required"] ?? false,
                $field["value"] ?? ""
            );
        } ?>
        <?php if (!empty($formData["tabla"])): ?>
            <input type="hidden" name="tabla" value="<?= htmlspecialchars($formData["tabla"]) ?>">
        <?php endif; ?>
        <div class="mt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                <?= $formData["submit"] ?? "Enviar" ?>
            </button>
        </div>
        <?php if (!empty($formData["useModal"])) {
            include_once __DIR__ . "/modal.php";
        } ?>
    </form>
</div>
<?php
}

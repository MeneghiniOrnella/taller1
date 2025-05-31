<?php include('src/components/input.php'); ?>

<form action="<?= $formData['action'] ?? '' ?>" method="<?= $formData['method'] ?? 'post' ?>">
    <?php
    foreach ($formData['fields'] as $field) {
        renderInput(
            $field['name'],
            $field['label'],
            $field['type'] ?? 'text',
            $field['required'] ?? false,
            $field['value'] ?? ''
        );
    }
    ?>
    <div>
        <button type="submit"><?= $formData['submit'] ?? 'Enviar' ?></button>
    </div>

    <?php
    (!empty($formData['useAlerts'])) && include('src/components/alert.php') : '';
    (!empty($formData['useModal'])) && include('src/components/modal.php') : '';
    ?>
</form>

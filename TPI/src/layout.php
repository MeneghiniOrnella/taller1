<?php
include_once(__DIR__ . '/components/header.php');
// var_dump($_GET);
include_once(__DIR__ . '/components/alert.php');
?>

<main class="max-w-7xl mx-auto px-4 py-6">
    <?= $content ?>
</main>

<?php
include_once(__DIR__ . '/components/footer.php');
?>
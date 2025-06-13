<?php function renderHeader($navItems)
{
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? "Administración de Egresados" ?></title>
    <link rel="icon" href="/taller1/TPI/public/assets/favicon.ico" type="image/x-icon">
    <link href="/taller1/TPI/public/assets/output.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-white text-gray-800">
    <nav class="bg-gradient-to-r from-black via-green-500 to-black shadow-md text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="text-2xl font-semibold tracking-wide">
                    <a href="/taller1/TPI/index.php">Administración de Egresados</a>
                </div>
                <div class="space-x-4 flex items-center">
                    <?php foreach ($navItems as $label => $href): ?>
                        <a href="<?= $href ?>" class="link hover:bg-green-700">
                            <?= $label ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </nav>
<?php
} ?>

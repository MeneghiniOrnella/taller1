<?php function renderHeader() { ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Administración de Egresados' ?></title>
    <link rel="icon" href="/taller1/TPI/public/assets/favicon.ico" type="image/x-icon">
    <link href="/taller1/TPI/public/assets/output.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-white text-gray-800">
    <nav class="bg-gradient-to-r from-black via-green-500 to-black shadow-md text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="text-2xl font-semibold tracking-wide">
                    Administración de Egresados
                </div>
                <div class="space-x-4 flex items-center">
                    <?php if (!empty($navItems) && is_array($navItems)): ?>
                        <?php foreach ($navItems as $label => $href): ?>
                            <a href="<?= $href ?>" class="link">
                                <?= $label ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['logged'])): ?>
                        <a href="/views/logout.php" class="bg-white text-blue-700 px-3 py-1 rounded hover:bg-blue-100 transition duration-200 text-sm font-semibold">
                            Cerrar sesión
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
<?php } ?>
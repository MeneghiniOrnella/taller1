<?php
http_response_code(404);

require_once __DIR__ . "/../components/header.php";
require_once __DIR__ . "/../components/footer.php";

$navItems = [
    "Inicio" => "/taller1/TPI/index.php",
];

renderHeader($navItems);
?>
<body class="bg-green-50 text-red-900 font-sans flex flex-col items-center justify-center h-screen px-4">
    <div class="text-center">
        <h1 class="text-8xl font-bold mb-4">404</h1>
        <p class="text-xl mb-6">Lo sentimos, la página que estás buscando no existe.</p>
        <a href="/index.php" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
            Volver al inicio
        </a>
    </div>
</body>
</html>

<?php
renderFooter();
?>
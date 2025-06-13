<?php
echo "<h1>Bienvenido, " . htmlspecialchars($_SESSION['admin_user']) . "</h1>";
echo "<a href='logout.php'>Cerrar sesión</a>";
?>

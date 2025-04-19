<?php
// La funcion RAND en PHP retorna un valor aleatorio entre un rango de dos enteros: Por ejemplo:
// $num = rand(1,10);
// La variable num tendrá un valor entre 1 y 10.
// Desarrolle un programa que muestre la tabla de multiplicar de un número aleatorio entre 1 y 10.
// El programa debe generar el código HTML de forma correcta, utilizando las etiquetas vistas en el curso. Envíe al tutor el archivo “. php”.
$num = rand(1, 10);
for ($i = 1; $i <= 10; $i++) {
    echo "<p>$num x $i = " . ($num * $i) . "</p>";
}
?>
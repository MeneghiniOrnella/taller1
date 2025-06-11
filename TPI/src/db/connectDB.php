<?php
function connectDB()
{
    $conn = mysqli_connect("localhost", "root", "", "taller1-tpi");
    if (!$conn) {
        die("❌ Error de conexión: " . mysqli_connect_error());
    }
    return $conn;
} ?>

<?php
function connectDB()
{
    $conn = mysqli_connect("localhost", "root", "", "taller1-tpi");
    if (!$conn) {
        $alert = ["type" => "error", "message" => mysqli_connect_error()];
    }
    return $conn;
} ?>

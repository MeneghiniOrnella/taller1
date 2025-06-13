<?php
require_once "connectDB.php";
require_once "createTables.php";

try {
    $conn = connectDB();
    createTables($conn);
    $alert = ["type" => "success", "message" => "Tablas creadas e inicializadas correctamente."];
} catch (Exception $e) {
    $alert = ["type" => "error", "message" => $e->getMessage()];
}
?>
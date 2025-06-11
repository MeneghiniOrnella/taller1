<?php
session_start();
if (!isset($_SESSION["logged"]) || !$_SESSION["logged"]) {
    header("Location: /TPI/public/views/auth/login.php");
    exit();
}
?>

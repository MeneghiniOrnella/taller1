<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../views/auth/login.php');
    exit;
}

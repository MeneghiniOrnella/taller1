<?php
include('../utils/db.php');
include('helpers/handle_redirect.php');
include('../middleware/auth.php');

$id = $_GET['id'];
$conn = connectDB();
mysqli_query($conn, "UPDATE egresados SET estado = 'aprobado' WHERE id = $id");

redirectWith('../views/egresados/lista.php', 'success', 1);

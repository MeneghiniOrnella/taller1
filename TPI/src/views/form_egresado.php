<?php
require_once 'src/db/connect.php';

$conn = connectDB();

$id = $_GET['id'] ?? null;
$egresado = ['nombre' => '', 'apellido' => '', 'matricula' => '', 'email' => '', 'telefono' => '', 'carrera_id' => '', 'estado' => 'pendiente'];

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM egresados WHERE id = $id");
    $egresado = mysqli_fetch_assoc($res);
}

$carreras = mysqli_query($conn, "SELECT id, nombre FROM carreras");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    if ($id) {
        $sql = "UPDATE egresados SET nombre='$nombre', apellido='$apellido', matricula=$matricula,
                email='$email', telefono=$telefono, carrera_id=$carrera_id, estado='$estado' WHERE id=$id";
    } else {
        $sql = "INSERT INTO egresados (nombre, apellido, matricula, email, telefono, carrera_id, estado)
                VALUES ('$nombre', '$apellido', $matricula, '$email', $telefono, $carrera_id, '$estado')";
    }

    mysqli_query($conn, $sql);
    header("Location: index.php?tabla=egresados");
    exit;
}
?>

<h2><?= $id ? "Editar" : "Nuevo" ?> Egresado</h2>
<form method="post">
    <label>Nombre: <input name="nombre" value="<?= $egresado['nombre'] ?>"></label><br>
    <label>Apellido: <input name="apellido" value="<?= $egresado['apellido'] ?>"></label><br>
    <label>Matrícula: <input name="matricula" value="<?= $egresado['matricula'] ?>"></label><br>
    <label>Email: <input name="email" value="<?= $egresado['email'] ?>"></label><br>
    <label>Teléfono: <input name="telefono" value="<?= $egresado['telefono'] ?>"></label><br>
    <label>Carrera:
        <select name="carrera_id">
            <?php while ($c = mysqli_fetch_assoc($carreras)) { ?>
                <option value="<?= $c['id'] ?>" <?= $c['id'] == $egresado['carrera_id'] ? 'selected' : '' ?>>
                    <?= $c['nombre'] ?>
                </option>
            <?php } ?>
        </select>
    </label><br>
    <label>Estado:
        <select name="estado">
            <option value="pendiente" <?= $egresado['estado'] === 'pendiente' ? 'selected' : '' ?>>pendiente</option>
            <option value="aprobado" <?= $egresado['estado'] === 'aprobado' ? 'selected' : '' ?>>aprobado</option>
            <option value="rechazado" <?= $egresado['estado'] === 'rechazado' ? 'selected' : '' ?>>rechazado</option>
        </select>
    </label><br><br>
    <button type="submit">Guardar</button>
</form>

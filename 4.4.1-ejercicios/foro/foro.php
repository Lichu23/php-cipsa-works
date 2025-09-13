<?php
session_start();

$foroFile = "foro.dat";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["usuario"])) {
    $mensaje = trim($_POST["mensaje"] ?? "");
    if ($mensaje !== "") {
        $usuario = $_SESSION["usuario"];
        $fecha = date("Y-m-d H:i:s");
        $linea = "[$fecha] $usuario: $mensaje" . PHP_EOL;
        file_put_contents($foroFile, $linea, FILE_APPEND);
    }
    header("Location: foro.php");
    die();
}

// Leer mensajes
$mensajes = [];
if (file_exists($foroFile)) {
    $mensajes = file($foroFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro público</title>
</head>
<body>
    <h1>Foro público</h1>

    <h2>Mensajes</h2>
    <div style="border:1px solid #333; padding:10px; max-width:600px;">
        <?php if (empty($mensajes)): ?>
            <p>No hay mensajes aún.</p>
        <?php else: ?>
            <?php foreach ($mensajes as $m): ?>
                <p><?= htmlspecialchars($m) ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <hr>

    <?php if (isset($_SESSION["usuario"])): ?>
        <h2>Publicar un mensaje</h2>
        <form method="post">
            <textarea name="mensaje" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Enviar">
        </form>
        <p><a href="cierre.php">Cerrar sesión (<?= htmlspecialchars($_SESSION["usuario"]) ?>)</a></p>
    <?php else: ?>
        <p><a href="inicio.php">Iniciar sesión para publicar mensajes</a></p>
    <?php endif; ?>
</body>
</html>

<?php
$archivoMensajes = __DIR__ . "/foro-mensajes/mensajes.dat";
$mensajes = [];

if (file_exists($archivoMensajes)) {
    $lineas = file($archivoMensajes, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $msg = [];
    foreach ($lineas as $linea) {
        if ($linea === "<mensaje>") {
            $msg = [];
        } elseif ($linea === "</mensaje>") {
            $mensajes[] = $msg;
        } else {
            $msg[] = $linea;
        }
    }
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
    <p><a href="publicacion.php">Publicar un mensaje</a></p>
    <hr>

    <?php foreach ($mensajes as $m): ?>
        <?php 
        $usuario = $m[0] ?? "Anonimo";
        $fecha   = $m[1] ?? "";
        $texto   = array_slice($m, 2);

        $foto = "perfiles/" . $usuario . ".jpg";
        if (!file_exists($foto)) {
            $foto = "https://via.placeholder.com/80x80.png?text=No+Foto";
        }
        ?>
        <div style="margin-bottom:20px;border:1px solid #ccc;padding:10px;">
            <img src="<?= htmlspecialchars($foto) ?>" alt="foto" width="80" style="float:left;margin-right:10px;">
            <strong><?= htmlspecialchars($usuario) ?></strong><br>
            <em><?= htmlspecialchars($fecha) ?></em><br><br>
            <div><?= nl2br(htmlspecialchars(implode("\n", $texto))) ?></div>
            <div style="clear:both"></div>
        </div>
    <?php endforeach; ?>
</body>
</html>

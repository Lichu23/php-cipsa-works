<?php
$error = "";
$archivoUsuarios = __DIR__ . "/perfiles/usuarios.dat";
$archivoMensajes = __DIR__ . "/foro-mensajes/mensajes.dat";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $clave   = trim($_POST["clave"] ?? "");
    $contenido = trim($_POST["contenido"] ?? "");

    // Validaciones
    if ($usuario === "" || $clave === "") {
        $error = "Usuario y contraseña son obligatorios.";
    } elseif ($contenido === "") {
        $error = "El mensaje no puede estar vacío.";
    } else {
        // Validar usuario
        $ok = false;
        if (file_exists($archivoUsuarios)) {
            $lineas = file($archivoUsuarios, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lineas as $linea) {
                list($u, $p) = array_map("trim", explode(",", $linea));
                if ($usuario === $u && $clave === $p) {
                    $ok = true;
                    break;
                }
            }
        }
        if (!$ok) {
            $error = "Usuario o contraseña incorrectos.";
        } else {
            // Limpiar caracteres no permitidos
            $contenido = str_replace(["<", ">"], "", $contenido);
            $fecha = date("Y-m-d H:i:s");

            $nuevoMensaje = "<mensaje>" . PHP_EOL .
                            $usuario . PHP_EOL .
                            $fecha . PHP_EOL .
                            $contenido . PHP_EOL .
                            "</mensaje>" . PHP_EOL;

            file_put_contents($archivoMensajes, $nuevoMensaje, FILE_APPEND);
            header("Location: foro.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicar mensaje</title>
</head>
<body>
    <h1>Publicar mensaje</h1>
    <?php if ($error): ?><p style="color:red"><?= htmlspecialchars($error) ?></p><?php endif; ?>

    <form method="post">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="clave" required><br><br>

        <label>Mensaje:</label><br>
        <textarea name="contenido" rows="5" cols="40" required></textarea><br><br>

        <input type="submit" value="Publicar">
    </form>
    <p><a href="foro.php">Volver al foro</a></p>
</body>
</html>

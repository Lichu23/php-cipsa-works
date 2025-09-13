<?php
$error = "";
$carpeta = __DIR__ . "/perfiles";

if (!is_dir($carpeta)) {
    mkdir($carpeta, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $clave1  = trim($_POST["clave1"] ?? "");
    $clave2  = trim($_POST["clave2"] ?? "");

    if ($usuario === "") {
        $error = "Debes indicar un nombre de usuario.";
    } elseif (strpos($usuario, ",") !== false) {
        $error = "El nombre no puede contener comas.";
    } elseif ($clave1 === "" || $clave2 === "") {
        $error = "Debes introducir la contraseña dos veces.";
    } elseif ($clave1 !== $clave2) {
        $error = "Las contraseñas no coinciden.";
    } elseif (strpos($clave1, ",") !== false) {
        $error = "La contraseña no puede contener comas.";
    } elseif (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
        $error = "Debes seleccionar una foto de perfil.";
    } else {
        // Validar archivo
        $foto = $_FILES["foto"];
        $info = pathinfo($foto["name"]);
        $ext  = strtolower($info["extension"] ?? "");
        if ($ext !== "jpg" && $ext !== "jpeg") {
            $error = "La foto debe estar en formato JPG.";
        } elseif ($foto["size"] > 500 * 1024) {
            $error = "La foto no puede superar los 500KB.";
        } else {
            // Guardar datos
            $archivoUsuarios = $carpeta . "/usuarios.dat";
            $linea = $usuario . "," . $clave1 . PHP_EOL;
            file_put_contents($archivoUsuarios, $linea, FILE_APPEND);

            // Guardar foto
            $destino = $carpeta . "/" . $usuario . ".jpg";
            move_uploaded_file($foto["tmp_name"], $destino);

            echo "<h2>Usuario registrado correctamente.</h2>";
            echo '<p><a href="foro.php">Ir al foro</a></p>';
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
</head>
<body>
    <h1>Registro</h1>
    <?php if ($error): ?><p style="color:red"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="clave1" required><br><br>

        <label>Repetir contraseña:</label><br>
        <input type="password" name="clave2" required><br><br>

        <label>Foto de perfil (JPG max 500Kb):</label><br>
        <input type="file" name="foto" accept=".jpg,.jpeg" required><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>

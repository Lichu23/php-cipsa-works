<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: estadisticas.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Admin</title>
</head>
<body>
    <h1>Login Administrador</h1>
    <form method="post" action="verificar.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>

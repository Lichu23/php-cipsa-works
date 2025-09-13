<?php
session_start();
require_once "logger.php";

if (isset($_SESSION["cuenta"])) {
    registrarAcceso($_SESSION["nombre"]);
    header("Location: gestion.php");
    die();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cuenta = trim($_POST["cuenta"] ?? "");
    $pin    = trim($_POST["pin"] ?? "");

    $archivo = __DIR__ . "/cuentas.dat";
    if (file_exists($archivo)) {
        $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            list($nCuenta, $p, $nombre, $apellido, $saldo) = array_map("trim", explode(",", $linea));
            if ($cuenta === $nCuenta && $pin === $p) {
                $_SESSION["cuenta"]  = $nCuenta;
                $_SESSION["nombre"]  = $nombre;
                $_SESSION["apellido"]= $apellido;
                $_SESSION["saldo"]   = (float)$saldo;

                registrarAcceso($nombre);
                // registrar cookie último acceso
                setcookie("ultimo_acceso_" . $nCuenta, date("Y-m-d H:i:s"), time() + 3600*24*30, "/");

                header("Location: gestion.php");
                die();
            }
        }
    }
    $error = "Número de cuenta o PIN incorrectos.";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banco - Login</title>
</head>
<body>
    <h1>Acceso a banca online</h1>
    <?php if ($error): ?><p style="color:red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post">
        <label for="cuenta">Nº de cuenta:</label>
        <input type="text" id="cuenta" name="cuenta" required><br><br>

        <label for="pin">PIN:</label>
        <input type="password" id="pin" name="pin" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>

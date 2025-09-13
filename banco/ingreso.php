<?php
session_start();
require_once "logger.php";

if (!isset($_SESSION["cuenta"])) {
    registrarAcceso("anonimo");
    header("Location: index.php");
    die();
}

registrarAcceso($_SESSION["nombre"]);

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cantidad = floatval($_POST["cantidad"] ?? 0);
    if ($cantidad > 0 && $cantidad < 10000) {
        $_SESSION["saldo"] += $cantidad;
        
        // actualizar en fichero
        $archivo = __DIR__ . "/cuentas.dat";
        $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
        foreach ($lineas as &$linea) {
            $partes = array_map("trim", explode(",", $linea));
            if ($partes[0] === $_SESSION["cuenta"]) {
                $partes[4] = $_SESSION["saldo"];
                $linea = implode(",", $partes);
                break;
            }
        }
        file_put_contents($archivo, implode(PHP_EOL, $lineas) . PHP_EOL);
        header("Location: gestion.php");
        die();
    } else {
        $error = "Cantidad inválida. Debe ser mayor que 0 y menor de 10.000.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso</title>
</head>
<body>
    <h1>Ingresar dinero</h1>
    <?php if ($error): ?><p style="color:red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post">
        <label for="cantidad">Cantidad (€):</label>
        <input type="number" id="cantidad" name="cantidad" step="0.01" required><br><br>
        <input type="submit" value="Ingresar">
    </form>
    <p><a href="gestion.php">Volver</a></p>
</body>
</html>

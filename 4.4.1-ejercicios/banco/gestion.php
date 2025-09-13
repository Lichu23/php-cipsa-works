<?php
session_start();
require_once "logger.php";

if (!isset($_SESSION["cuenta"])) {
    registrarAcceso("anonimo");
    header("Location: index.php");
    die();
}

registrarAcceso($_SESSION["nombre"]);
$cuenta   = $_SESSION["cuenta"];
$nombre   = $_SESSION["nombre"];
$apellido = $_SESSION["apellido"];
$saldo    = $_SESSION["saldo"];

$cookie = "ultimo_acceso_" . $cuenta;
$ultimoAcceso = $_COOKIE[$cookie] ?? "Es tu primer acceso";
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestion bancaria</title>
</head>
<body>
    <h1>Bienvenido <?= htmlspecialchars($nombre . " " . $apellido) ?></h1>
    <p><strong>Nº Cuenta:</strong> <?= htmlspecialchars($cuenta) ?></p>
    <p><strong>Saldo actual:</strong> <?= number_format($saldo, 2) ?> €</p>
    <p><strong>Ultimo acceso:</strong> <?= htmlspecialchars($ultimoAcceso) ?></p>

    <form action="ingreso.php" method="get">
        <button type="submit">Ingreso</button>
    </form>
    <form action="reintegro.php" method="get">
        <button type="submit">Reintegro</button>
    </form>
    <form action="logout.php" method="get">
        <button type="submit">Salir</button>
    </form>
</body>
</html>

<?php
session_start();

$usuario = $_POST["usuario"] ?? "";
$clave   = $_POST["clave"] ?? "";

if ($usuario === "alumno" && $clave === "cipsa") {
    $_SESSION["admin"] = true;
    header("Location: estadisticas.php");
    die();
} else {
    echo "<h1>Acceso denegado</h1>";
    echo "<p><a href='admin.php'>Intentar de nuevo</a></p>";
}
?>
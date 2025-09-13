<?php
session_start();

if (!isset($_POST["usuario"]) || !isset($_POST["clave"])) {
    header("Location: inicio.php");
    die();
}

$usuario = trim($_POST["usuario"]);
$clave   = trim($_POST["clave"]);

$archivo = __DIR__ . "/psw.dat"; // ruta absoluta

$acceso = false;

if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        $partes = array_map("trim", explode(",", $linea, 2));
        if (count($partes) === 2) {
            list($user, $pass) = $partes;
            echo "<pre>";
            var_dump($usuario, $clave, $user, $pass);
            echo "</pre>";
            if ($usuario === $user && $clave === $pass) {
                $acceso = true;
                break;
            }
        }
    }
}

if ($acceso) {
    $_SESSION["usuario"] = $usuario;
    header("Location: foro.php");
    die();
} else {
    http_response_code(403);
    echo "<h1>403 Forbidden</h1>";
    echo "<p>Usuario o contraseña incorrectos.</p>";
    echo '<p><a href="inicio.php">Volver</a></p>';
    die();
}
?>
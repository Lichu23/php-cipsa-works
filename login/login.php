<?php 
    session_start();

    if(!isset($_POST["usuario"]) || !isset($_POST["clave"]) ) {
        header("Location: inicio.php");
        die();
    }

    $usuario = trim($_POST["usuario"]);
    $clave =  trim($_POST["clave"]);

    $archivo = "psw.dat";

    $accceso = false;

    if(file_exists($archivo)) {
        $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        list($user, $pass) = explode(",", $linea, 2);
    if ($usuario === trim($user) && $clave === trim($pass)) {
            $acceso = true;
            break;
        }
    }
}


if($accceso) {
    $_SESSION["usuario"] = $usuario;
    header("Location: home.php");
    die();
} else {
    http_response_code(403);
    echo "<h1>403 Forbidden</h1>";
    echo "<p>Usuario o contraseña incorrectos.</p>";
    echo '<a href="inicio.php">Volver</a>';
    die();
}

?>
<?php 
    session_start();

    if(!isset($_SESSION["usuario"])) {
        header("Location: inicio.php");
        die();
    }

    $nombre = $_SESSION["usuario"]
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Bienvenido <?=$nombre?> </h1>
    <a href="cierre.php">Cerrar Session</a>
</body>
</html>
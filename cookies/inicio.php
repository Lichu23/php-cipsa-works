<?php 

session_start();

if(isset($_SESSION["usuario"])) {
    header("Location: home.php"); //redirect to home.php
    die();
}

if(isset($_POST["usuario"])) {
    $usuario = filter_input(INPUT_POST,  "usuario");
    $_SESSION["usuario"] = $usuario;
    header("Location: home.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <form method="post">
        <label for="usuario">Nombre</label>
        <input type="text" id="usuario" name="usuario"/>
        <input type="submit" value="ok"/>
    </form>
</body>
</html>
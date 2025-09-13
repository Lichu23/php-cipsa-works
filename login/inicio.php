<?php 

    session_start();
    if(isset($_SESSION["usuario"])) {
        header("Location: home.php");
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<form action="login.php" method="post">
    <label for="usuario">Usuario</label>    
<input type="text" id="usuario" name="usuario" required>

<label for="contraseña">Contraseña</label>    
<input type="password" id="contraseña" name="clave" required>

<input type="submit" value="Entrar">
</form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos</title>
</head>
<body>
    <h1>Datos enviados por el formulario</h1>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_POST['nombre']); ?></p>
    <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($_POST["apellidos"]); ?></p>
    <p><strong>Pais:</strong> <?php echo htmlspecialchars($_POST["pais"]); ?></p>
    
    <p><strong>Preferencias:</strong></p>
    <ul>
    <?php 
        if(!empty($_POST["preferencia"])) {
            foreach ($_POST["preferencia"] as $preference) {
                echo "<li>" . htmlspecialchars($preference). "</li>"; 
            }
        } else {
            echo "<li>No seleecciono ninguna preferencia</li>";
        }
        
    ?>
    </ul>
</body>
</html>
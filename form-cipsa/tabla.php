<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Multiplicar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            margin-top: 15px;
        }
        td {
            border: 1px solid black;
            padding: 5px 10px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Tabla de Multiplicar</h2>

    <form method="post">
        <label for="numero">Introduce un número (1-10): </label>
        <input type="number" name="numero" id="numero" required>
        <button type="submit">Mostrar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $numero = intval($_POST["numero"]);

        if ($numero >= 1 && $numero <= 10) {
            echo "<h3>Tabla de multiplicar del $numero</h3>";
            echo "<table>";
            for ($i = 1; $i <= 10; $i++) {
                $resultado = $numero * $i;
                echo "<tr><td>$numero × $i</td><td>= $resultado</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='error'>❌ Error: el número debe estar entre 1 y 10.</p>";
        }
    }
    ?>
</body>
</html>

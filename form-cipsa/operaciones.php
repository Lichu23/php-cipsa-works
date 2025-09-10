<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Operaciones Aritméticas</title>
</head>
<body>
    <h2>Operaciones Aritméticas</h2>

    <form method="post">
        <label for="num1">Número 1: </label>
        <input type="text" name="num1" id="num1" value="<?php echo $_POST['num1'] ?? ''; ?>">
        <br><br>

        <label for="num2">Número 2: </label>
        <input type="text" name="num2" id="num2" value="<?php echo $_POST['num2'] ?? ''; ?>">
        <br><br>

        <button type="submit" name="operacion" value="suma">Suma</button>
        <button type="submit" name="operacion" value="resta">Resta</button>
        <button type="submit" name="operacion" value="producto">Producto</button>
        <button type="submit" name="operacion" value="division">División</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operacion = $_POST['operacion'];

        if ($num1 === '' || $num2 === '' || !is_numeric($num1) || !is_numeric($num2)) {
            echo "<p class='error'>❌ Error: Debes introducir dos valores numéricos válidos.</p>";
        } else {
            $num1 = floatval($num1);
            $num2 = floatval($num2);
            $resultado = null;

            switch ($operacion) {
                case 'suma':
                    $resultado = $num1 + $num2;
                    echo "<p class='resultado'>✅ Resultado de la suma: $resultado</p>";
                    break;
                case 'resta':
                    $resultado = $num1 - $num2;
                    echo "<p class='resultado'>✅ Resultado de la resta: $resultado</p>";
                    break;
                case 'producto':
                    $resultado = $num1 * $num2;
                    echo "<p class='resultado'>✅ Resultado del producto: $resultado</p>";
                    break;
                case 'division':
                    if ($num2 == 0) {
                        echo "<p class='error'>❌ Error: No se puede dividir entre 0.</p>";
                    } else {
                        $resultado = $num1 / $num2;
                        echo "<p class='resultado'>✅ Resultado de la división: $resultado</p>";
                    }
                    break;
            }
        }
    }
    ?>
</body>
</html>

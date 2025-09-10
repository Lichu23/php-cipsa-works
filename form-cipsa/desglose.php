<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desglose de Monedas</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 10px 0;
        }
        td {
            border: 1px solid black;
            padding: 5px 10px;
            text-align: center;
        }
        .resaltado {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h2>DESGLOSE DE MONEDAS</h2>
    <form method="post">
        Cantidad a desglosar: 
        <input type="number" name="cantidad" min="1" required>
        <button type="submit">Ejecutar Desglose</button>

        <?php
        $denominaciones = [10000, 5000, 2000, 1000, 500, 200, 100, 50, 25, 10, 5, 2, 1];

        $acumulados = [];
        foreach ($denominaciones as $den) {
            $acumulados[$den] = isset($_POST["acumulado_$den"]) ? intval($_POST["acumulado_$den"]) : 0;
        }

        if (!empty($_POST["cantidad"])) {
            $cantidad = intval($_POST["cantidad"]);
            $resto = $cantidad;

            foreach ($denominaciones as $den) {
                $num = intdiv($resto, $den);
                $resto = $resto % $den;
                $acumulados[$den] += $num;
            }
        }

        echo "<table>";
        foreach ($denominaciones as $den) {
            echo "<tr>";
            echo "<td>$den</td>";
            echo "<td class='resaltado'>" . $acumulados[$den] . "</td>";
            echo "</tr>";
            echo "<input type='hidden' name='acumulado_$den' value='" . $acumulados[$den] . "'>";
        }
        echo "</table>";
        ?>
    </form>
</body>
</html>

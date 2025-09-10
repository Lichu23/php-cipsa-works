<?php
$errores = [];
$valores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    for ($i = 1; $i <= 10; $i++) {
        $campo = "num$i";
        $valor = trim($_POST[$campo] ?? '');

        if ($valor === '') {
            $errores[$campo] = "Campo Vacio";
        } elseif (!is_numeric($valor)) {
            $errores[$campo] = "Valor no válido";
        } else {
            $valores[$campo] = $valor;
        }
    }

    if (empty($errores)) {
        echo '<form id="redir" method="post" action="resultados.php">';
        foreach ($valores as $campo => $valor) {
            echo "<input type='hidden' name='$campo' value='$valor'>";
        }
        echo '</form>';
        echo '<script>document.getElementById("redir").submit();</script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de 10 números</title>
    <style>
        input.error { background-color: #ffb3b3; }
        span.error { color: red; font-weight: bold; margin-left: 10px; }
        label { display: block; margin-top: 10px; }
        button { margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Introduzca 10 números</h2>
    <form method="post">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            $campo = "num$i";
            $valorInput = $_POST[$campo] ?? '';
            $claseError = isset($errores[$campo]) ? 'error' : '';
            echo "<label>Número de muestra $i: 
                    <input type='text' name='$campo' value='".htmlspecialchars($valorInput)."' class='$claseError'>";
            if (isset($errores[$campo])) {
                echo "<span class='error'>{$errores[$campo]}</span>";
            }
            echo "</label>";
        }
        ?>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>

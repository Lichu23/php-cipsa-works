<?php
$valores = [];

for ($i = 1; $i <= 10; $i++) {
    $campo = "num$i";
    if (isset($_POST[$campo]) && is_numeric($_POST[$campo])) {
        $valores[] = floatval($_POST[$campo]);
    }
}

if (count($valores) !== 10) {
    header("Location: datos.php");
    exit();
}

$max = max($valores);
$min = min($valores);
$sum = array_sum($valores);
$media = $sum / count($valores);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
</head>
<body>
    <h2>Resultados</h2>
    <ul>
        <li>Valor más grande: <?php echo $max; ?></li>
        <li>Valor más pequeño: <?php echo $min; ?></li>
        <li>Sumatorio: <?php echo $sum; ?></li>
        <li>Media: <?php echo $media; ?></li>
    </ul>
    <a href="datos.php">Volver al formulario</a>
</body>
</html>

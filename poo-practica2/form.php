<?php

require_once "clases/controles.class.php";

$moneda = new listbox("moneda");
$cifra = new validatebox("cifra", "", 10); 
$dni_input = new textbox("dni", "");
$dni = new dni("");

$moneda->opcion(new listboxopcion("Euro -> Dolar", "EURO -> DOLAR"));
$moneda->opcion(new listboxopcion("Dolar -> Euro", "DOLAR -> EURO"));

$cantidad = $cifra->getvalor();
$dni_valor = $dni_input->getvalor();
$resultado = '';
$dni_mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["calcular"])) {
    $cantidad = $_POST["cifra"];
    $dni_valor = $_POST["dni"];
    $dni = new dni($dni_valor); // Actualizar instancia de dni
    $valor_moneda = $moneda->getvalor();
    $tipo_cambio = ($valor_moneda === "EURO -> DOLAR") ? 1.10 : ($valor_moneda === "DOLAR -> EURO" ? 0.91 : 1.0);

    if ($cifra->esValido() && is_numeric($cantidad) && $cantidad >= 0) {
        $resultado = $cantidad * $tipo_cambio;
        $moneda_resultado = trim(explode("->", $valor_moneda)[1]);
        $resultado = number_format($resultado, 2) . " " . $moneda_resultado;
    } else {
        $resultado = "Por favor, ingrese una cantidad válida.";
    }
    $dni_mensaje = $dni->validar() ? "DNI válido" : "DNI no válido";
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Moneda</title>
    <style>
        .error-message {
            margin-left: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Cambio de Moneda</h1>

    <form method="post" action="">
        <label for="cifra">Cantidad:</label> <?php echo $cifra->html(); ?><br>
        <label for="moneda">Moneda:</label> <?php echo $moneda->html(); ?><br>
        <label for="dni">DNI:</label> <?php echo $dni_input->html(); ?><br>
        <input type="submit" name="calcular" value="Calcular">
    </form>

    <?php if (!empty($resultado)) { ?>
        <p>Resultado: <?php echo $resultado; ?></p>
    <?php } ?>
    <?php if ($dni_mensaje) { ?>
        <p><?php echo $dni_mensaje; ?></p>
    <?php } ?>
</body>
</html>
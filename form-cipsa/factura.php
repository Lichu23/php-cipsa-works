<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Fruteria</title>
</head>
<body>
      <?php
    $producto = $_POST['producto'] ?? '';
    $cantidad = floatval($_POST['cantidad'] ?? 0);
    $pagoVisa = isset($_POST['pago']) && $_POST['pago'] === 'Visa';

    $precios = [
        "Judías" => 2.0,
        "Garbanzos" => 2.5,
        "Lentejas" => 1.25
    ];

    if ($producto && $cantidad > 0) {
        $precioKg = $precios[$producto];
        $importeBase = $cantidad * $precioKg;
        $descuento = 0;

        if ($cantidad > 50) {
            $descuento += 0.10; 
        } elseif ($cantidad > 10) {
            $descuento += 0.02; 
        }

        if ($pagoVisa) {
            $descuento += 0.05;
        }

        $importeFinal = $importeBase * (1 - $descuento);

        echo "<p><strong>Producto:</strong> $producto</p>";
        echo "<p><strong>Cantidad:</strong> $cantidad Kg</p>";
        echo "<p><strong>Precio por Kg:</strong> " . number_format($precioKg, 2) . " €</p>";
        echo "<p><strong>Importe base:</strong> " . number_format($importeBase, 2) . " €</p>";
        echo "<p><strong>Descuento aplicado:</strong> " . ($descuento * 100) . " %</p>";
        echo "<p><strong>Importe final:</strong> <span style='color:green; font-weight:bold;'>" 
             . number_format($importeFinal, 2) . " €</span></p>";
    } else {
        echo "<p style='color:red;'>Debes seleccionar un producto y una cantidad válida.</p>";
    }
    ?>
</body>
</html>
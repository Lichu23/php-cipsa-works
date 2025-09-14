<?php
require_once "automovil.class.php";

$vehiculos = [
    new Automovil("1234ABC", "Toyota", "Corolla", "Gasolina"),
    new Automovil("5678XYZ", "Tesla", "Model 3", "Eléctrico"),
    new Automovil("1111AAA", "Ford", "Focus", "Diésel"),
    new Automovil("2222BBB", "BMW", "X5", "Híbrido")
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Automóviles</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Listado de Automóviles</h1>
    <table>
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Combustible</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($vehiculos as $auto) {
                $auto->mostrarVehiculos();
            }
            ?>
        </tbody>
    </table>
</body>
</html>

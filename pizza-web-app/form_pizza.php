<?php
session_start();
require_once 'modelo/datos.php';
require_once 'clases/pizza.class.php';

// Si el formulario se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombrePizza = $_POST['pizza'];
    $tipo = $_POST['tamano'];

    $_SESSION['pizza'] = [
        'nombre' => $nombrePizza,
        'tipo' => $tipo,
        'precio_base' => $_pizzas[$nombrePizza]->getPrecio($tipo),
        'ingredientes' => []
    ];

    header('Location: form_ingredientes.php');
    exit;
}
?>

<h2>Selecciona tu pizza</h2>
<form method="post">
    <label>Tipo de pizza:</label>
    <select name="pizza">
        <?php foreach ($_pizzas as $nombre => $obj): ?>
            <option value="<?= $nombre ?>"><?= $nombre ?></option>
        <?php endforeach; ?>
    </select>

    <label>Tamaño:</label>
    <select name="tamano">
        <option value="mediana">Mediana</option>
        <option value="normal">Normal</option>
        <option value="familiar">Familiar</option>
    </select>

    <button type="submit">Pizza</button>
</form>

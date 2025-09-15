<?php
session_start();
require_once 'modelo/datos.php';
require_once 'clases/ingrediente.class.php';
require_once 'clases/pizza.class.php';

// Si no hay pizza seleccionada, volver al formulario inicial
if (!isset($_SESSION['pizza'])) {
    header('Location: form_pizza.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ingrediente'])) {
    $nombreIng = $_POST['ingrediente'];
    $cantidad = $_POST['cantidad'];

    $precio = $_ingredientes[$nombreIng]->getPrecio($cantidad);

    $_SESSION['pizza']['ingredientes'][] = [
        'nombre' => $nombreIng,
        'cantidad' => $cantidad,
        'precio' => $precio
    ];
}

if (isset($_GET['descartar'])) {
    unset($_SESSION['pizza']);
    header('Location: form_pizza.php');
    exit;
}

if (isset($_GET['pagar'])) {
    header('Location: form_pago.php');
    exit;
}

?>

<h2>Ingredientes de la pizza <?= $_SESSION['pizza']['nombre'] ?> (<?= $_SESSION['pizza']['tipo'] ?>)</h2>

<form method="post">
    <label>Ingrediente:</label>
    <select name="ingrediente">
        <?php foreach ($_ingredientes as $nombre => $obj): ?>
            <option value="<?= $nombre ?>"><?= $nombre ?></option>
        <?php endforeach; ?>
    </select>

    <label>Cantidad:</label>
    <input type="radio" name="cantidad" value="simple" checked> Simple
    <input type="radio" name="cantidad" value="doble"> Doble

    <button type="submit">Ingrediente</button>
</form>

<h3>Ingredientes seleccionados:</h3>
<ul>
    <?php foreach ($_SESSION['pizza']['ingredientes'] as $ing): ?>
        <li><?= $ing['nombre'] ?> (<?= $ing['cantidad'] ?>) - <?= $ing['precio'] ?> €</li>
    <?php endforeach; ?>
</ul>

<a href="form_ingredientes.php?descartar=1">DESCARTAR</a> |
<a href="form_ingredientes.php?pagar=1">PAGAR</a>

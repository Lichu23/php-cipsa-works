<?php
session_start();

// Si no hay pizza en sesión, volver al formulario inicial
if (!isset($_SESSION['pizza'])) {
    header('Location: form_pizza.php');
    exit;
}

$pizza = $_SESSION['pizza'];

$total = $pizza['precio_base'];
foreach ($pizza['ingredientes'] as $ingrediente) {
    $total += $ingrediente['precio'];
}
?>

<h2>Resumen de tu pedido</h2>
<p>Pizza: <?= $pizza['nombre'] ?> (<?= $pizza['tipo'] ?>) - Base: <?= $pizza['precio_base'] ?> €</p>

<h3>Ingredientes:</h3>
<ul>
    <?php foreach ($pizza['ingredientes'] as $ingrediente): ?>
        <li><?= $ingrediente['nombre'] ?> (<?= $ingrediente['cantidad'] ?>) - <?= $ingrediente['precio'] ?> €</li>
    <?php endforeach; ?>
</ul>

<h3>Precio final: <?= $total ?> €</h3>

<a href="form_pizza.php">Nueva pizza</a>

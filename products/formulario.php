<?php 
require_once 'classes/controls.class.php';
require_once 'entidades/compra.class.php';
require_once 'datos/datos.class.php';

$error_producto_desconocido = "";
$error_comprador = "";
$error_mail = "";
$sumatorio = 0.0;

$txt_comprador = new TextBox("txt_comprador");
$txt_email = new TextBox("txt_email");
$txt_id = new ValidateBox("txt_id", 5, true);            
$txt_cantidad = new ValidateBox("txt_cantidad", 2, true); 
$context = new Contexto("cbx");                          
$tbl_compra = new Tabla(["producto", "unidades", "precio", "importe"]);
$btn_add = new Boton("btn_add", "AÑADIR");
$btn_save = new Boton("btn_save", "REGISTRAR");

if ($context->getValor() != NULL) {
    $lista_compra = $context->getValor();
} else {
    $lista_compra = array();
}

if ($btn_add->fuePulsado()) {
    if ($txt_id->esValido() && $txt_cantidad->esValido()) {
        $id_producto = $txt_id->getValor();
        $cantidad = $txt_cantidad->getValor();

        $producto = Datos::obtenerPrecios($id_producto);

        if ($producto !== null) {
            $importe = $producto->getPrecio() * $cantidad;

            $encontrado = false;
            foreach ($lista_compra as &$item) {
                if ($item['id'] == $producto->getId()) {
                    // Si ya existe el producto, acumular unidades e importe
                    $item['unidades'] += $cantidad;
                    $item['importe'] = $item['unidades'] * $item['precio'];
                    $encontrado = true;
                    break;
                }
            }

            if (!$encontrado) {

                $lista_compra[] = [
                    "id" => $producto->getId(),
                    "nombre" => $producto->getNombre(),
                    "categoria" => $producto->getCategoria(),
                    "precio" => $producto->getPrecio(),
                    "unidades" => $cantidad,
                    "importe" => $importe
                ];
            }

            $error_producto_desconocido = "";
        } else {
            $error_producto_desconocido = "<span style='color:red'>Producto desconocido</span>";
        }
    } else {
        $error_producto_desconocido = "<span style='color:red'>ID o cantidad no válidos</span>";
    }
}


if ($btn_save->fuePulsado()) {
    if (!$txt_comprador->esValido()) {
        $error_comprador = "<span style='color:red'>Nombre requerido</span>";
    }
    if (!$txt_email->esValido() || !filter_var($txt_email->getValor(), FILTER_VALIDATE_EMAIL)) {
        $error_mail = "<span style='color:red'>Email no válido</span>";
    }

    if ($error_comprador === "" && $error_mail === "") {
        $compra = new Compra(
            $txt_comprador->getValor(),
            $txt_email->getValor(),
            $lista_compra
        );

        $archivo = Datos::registrarCompra($compra);

        echo "<h3 style='color:green'>Compra registrada correctamente.</h3>";
        echo "<p>Archivo generado: $archivo</p>";
        echo "<p>Importe bruto: " . number_format($compra->calcularImporte(), 2) . " €</p>";
        echo "<p>Importe con IVA: " . number_format($compra->calcularImporteIva(21), 2) . " €</p>";
    }
}




$sumatorio = 0;
$rows = [];
foreach($lista_compra as $prod) {
    $importe = $prod['precio'] * $prod['unidades'];
    $rows[] = [
        $prod['nombre'],
        $prod['unidades'],
        number_format($prod['precio'], 2),
        number_format($importe, 2)
    ];
    $sumatorio += $importe;
}
$tbl_compra->setValores($rows);

$context->setValor($lista_compra);

?>
<form method="post">
    <?php echo $context->html(); ?>
    <h1>COMPRADOR</h1>
    NOMBRE: <?php echo $txt_comprador->html(); ?> <?php echo $error_comprador; ?><br/>
    E-MAIL: <?php echo $txt_email->html(); ?> <?php echo $error_mail; ?><br/>
    <h2>PRODUCTO</h2>
    ID PRODUCTO: <?php echo $txt_id->html(); ?> <?php echo $error_producto_desconocido; ?><br/>
    CANTIDAD: <?php echo $txt_cantidad->html(); ?><br/>
    <?php echo $tbl_compra->html(); ?>
    <h2>IMPORTE FINAL: <?php echo number_format($sumatorio, 2); ?> €</h2>
    <?php echo $btn_add->html(); ?> <?php echo $btn_save->html(); ?>
</form>
<?php

?>
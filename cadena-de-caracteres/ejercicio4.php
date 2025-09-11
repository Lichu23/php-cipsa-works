<?php
function ajustarCadena($texto) {
    if (strlen($texto) > 30) {
        return substr($texto, 0, 30);
    }
    return str_pad($texto, 30, " ", STR_PAD_RIGHT);
}

echo "<pre>'" . ajustarCadena("Hola Mundo") . "'</pre>";

echo "<pre>'" . ajustarCadena("Esta es una cadena que supera los treinta caracteres") . "'</pre>";
?>

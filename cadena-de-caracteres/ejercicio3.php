<?php
function formatearNumero($valor) {
    $formateado = number_format($valor, 2, ".", "");
    return "#" . $formateado . "#";
}

// Ejemplos de uso:
echo formatearNumero(153.4);   
echo "<br>";
echo formatearNumero(7);        
echo "<br>";
echo formatearNumero(1234.567); 
?>
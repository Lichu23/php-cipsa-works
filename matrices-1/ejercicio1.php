<?php
function mostrarLista($array) {
   echo "<ul>";
   foreach ($array as $posicion => $valor) {
    echo "<li>Posicion: $posicion -- > Valor: $valor </li>";
   }
   echo "</ul>";
}

$miArray = [10, 20, 30, 40, 50];
mostrarLista($miArray);
?>
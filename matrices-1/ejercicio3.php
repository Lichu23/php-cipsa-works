<?php
function analizarArray($array) {
    
    $max = max($array);
    $posMax = array_search($max, $array); //encontramos la posicion del valor maximo 

    $min = min($array);
    $posMin = array_search($min, $array); //encontramos la posicion del valor minimo 

    $media = array_sum($array) / count($array);

    echo "Valor maximo: $max (posicion $posMax)<br>" ;
    echo "Valor minimo: $min (posicion $posMin)<br>";
    echo "Media: $media <br>";

}

$miArray = [10, 50, 30, 5, 90, 40];
analizarArray($miArray);
?>
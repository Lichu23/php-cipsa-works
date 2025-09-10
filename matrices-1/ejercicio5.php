    <?php 
    function generarMatrizMultiplicar($n) {
    $matriz = [];
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $n; $j++) {
            $matriz[$i][$j] = $i * $j;
        }
    }
    return $matriz;
}


function mostrarMatrizEnTabla($matriz) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    foreach ($matriz as $fila) {
        echo "<tr>";
        foreach ($fila as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}


$tablaMultiplicar = generarMatrizMultiplicar(10);
mostrarMatrizEnTabla($tablaMultiplicar);

?>



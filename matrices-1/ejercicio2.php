<?php
function mostrarTablaAsociativa($array) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Clave</th><th>Valor</th></tr>";
    foreach($array as $clave => $valor) {
        echo "<tr>";
        echo "<td>$clave</td>";
        echo "<td>$valor</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$miArrayAsociativo = [
    "nombre" => "Pedro",
    "apellidos" => "Gonzales",
    "edad" => 22,
];
mostrarTablaAsociativa($miArrayAsociativo);
?>
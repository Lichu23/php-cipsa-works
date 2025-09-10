<?php
$lista1 = ['a','b','c','d','e'];
$lista2 = ['v','w','x','y','z'];

echo "<h3>Listas iniciales</h3>";
echo "Lista1: "; print_r($lista1); echo "<br>";
echo "Lista2: "; print_r($lista2); echo "<br><br>";

$lista1 = array_merge($lista1, $lista2);
echo "<b>1. Lista1 con Lista2</b> ";
print_r($lista1);
echo "<br></br>";

array_push($lista1, '6');    
array_unshift($lista1, '1');
echo "<b>2. Lista1 después de agregar 1 y 6:</b> ";
print_r($lista1);
echo "<br><br>";

array_pop($lista1);  
array_shift($lista1); 
echo "<b>3. Lista1 después de eliminar 1 y 6:</b> ";
print_r($lista1);
echo "<br><br>";

array_push($lista1, '7', '8', '9');
echo "<b>4. Lista1 después de añadir 7, 8 y 9:</b> ";
print_r($lista1);
echo "<br><br>";

$ultimo = array_pop($lista1);
echo "<b>5. Último elemento eliminado:</b> $ultimo <br>";
echo "Lista1 resultante: ";
print_r($lista1);
echo "<br><br>";

$primero = array_shift($lista1);
echo "<b>6. Primer elemento eliminado:</b> $primero <br>";
echo "Lista1 resultante: ";
print_r($lista1);
echo "<br><br>";

$inverso = array_reverse($lista1);
echo "<b>7. Lista1 en orden inverso:</b> ";
print_r($inverso);
echo "<br><br>";

$ascendente = $lista1;
sort($ascendente);
echo "<b>8. Lista1 ordenado de menor a mayor:</b> ";
print_r($ascendente);
echo "<br>";

$descendente = $lista1;
rsort($descendente);
echo "<b>Lista1 ordenado de mayor a menor:</b> ";
print_r($descendente);
echo "<br><br>";

$posicion = array_search('e', $lista1);
if ($posicion !== false) {
    echo "<b>9. El elemento 'e' está en Lista1 en la posición:</b> $posicion <br>";
} else {
    echo "<b>9. El elemento 'e' no se encuentra en Lista1</b><br>";
}
?>

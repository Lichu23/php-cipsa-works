<?php
function compararCadenas($cadena1, $cadena2) {
    return strtolower($cadena1) === strtolower($cadena2);
}

$texto1 = "Hola Mundo";
$texto2 = "hola mundo";
$texto3 = "Adios";

echo "$texto1 = $texto2". var_dump(compararCadenas($texto1, $texto2))."<br>"; 
echo "$texto1 = $texto3". var_dump(compararCadenas($texto1, $texto3)) 

?>

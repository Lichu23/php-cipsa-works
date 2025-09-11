<?php
$cadena = "Estoy estudiando el capitulo relativo a las Cadenas de PHP";

//Cantidad de caracteres que contiene la cadena
echo "1. Total caracteres: " . strlen($cadena) . "<br>";

//Cantidad de caracteres sin contar espacios
echo "2. Caracteres sin espacios: " . strlen(str_replace(" ", "", $cadena)) . "<br>";

//La cadena en mayusculas
echo "3. Mayusculas: " . strtoupper($cadena) . "<br>";

// Longitud de la cadena
echo "4. Longitud: " . strlen($cadena) . "<br>";

// 5. Texto tras la palabra "las"
$posLas = strpos($cadena, "las");
echo "5. Texto tras 'las': " . substr($cadena, $posLas + strlen("las")) . "<br>";

// Posicion de la palabra "relativo"
echo "6. Posicion de 'relativo': " . strpos($cadena, "relativo") . "<br>";

//Subcadena del caracter 8 al 15
echo "Subcadena (8 a 15): " . substr($cadena, 7, 8) . "<br>";

// Ultimos 5 caracteres
echo "8. Ultimos 5: " . substr($cadena, -5) . "<br>";

// Reemplazar "capitulo" por "tema"
echo "9. Reemplazo: " . str_replace("capítulo", "tema", $cadena) . "<br>";

//Numero de "a"
echo "10. Nº de 'a': " . substr_count(strtolower($cadena), "a") . "<br>";

//Numero de palabras
echo "11. Nº de palabras: " . str_word_count($cadena) . "<br>";

//Palabras con "o"
$palabras = explode(" ", $cadena);
$palabrasConO = array_filter($palabras, function($palabra) {
    return stripos($palabra, "o") !== false;
});
echo "12. Palabras con 'o': " . implode(", ", $palabrasConO) . "<br>";
?>

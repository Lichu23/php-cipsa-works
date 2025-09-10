<?php
function obtenerCodigoColor($color) {
    $colores = [
        "Azul" => "#0000FF",
        "Rojo" => "#FF0000",
        "Magenta" => "#FF00FF",
        "Verde" => "#00FF00",
        "Cyan" => "#00FFFF",
        "Amarillo" => "#FFFF00",
        "Blanco" => "#FFFFFF"
    ];

    $colorFormateado = ucfirst(strtolower($color)); //primer caracter mayuscula
    if(array_key_exists($colorFormateado, $colores)) {
        return $colores[$colorFormateado];
    } else {
        return "Color no encontrado";
    }
}

$color = "rojo";
echo "El código del color $color es: " . obtenerCodigoColor($color);
?>
<?php 

function printIn($text) {
     echo $text;
}

?>

<?php 

function aleatorio($max, $min) {
    return rand($min, $max);
}

?>

<?php 

function dia() {
    date_default_timezone_set('Europe/Madrid');
    return date("l");
}

?>

<?php 

function mes() {
    date_default_timezone_set('Europe/Madrid');
    return date("F");
}

?>
<?php

function diaYMes() {
    date_default_timezone_set('Europe/Madrid');
    return date('l  F');
}
?>

<?php

function operaciones($v1, $v2, $oper = 1) {
    switch ($oper) {
        case 1:
            return $v1 + $v2;
        case 2:
            return $v1 - $v2; 
        case 3:
            return $v1 * $v2;
        case 4:
            if ($v2 == 0) {
                return "Error: División por cero";
            }
            return $v1 / $v2; 
        default:
            return $v1 + $v2; 
    }
}
?>


<?php

function sumatorio($param) {
    static $total = 0;
    $total += $param;
    return $total;

}

?>

<?php
function producto_iterativo($a, $b) {
    $resultado = 0;

    $signo = 1;
    if ($b < 0) {
        $b = -$b;
        $signo = -1;
    }

    for ($i = 0; $i < $b; $i++) {
        $resultado += $a;
    }

    return $resultado * $signo;
}
?>


<?php
function producto_recursivo($a, $b) {
    if ($b == 0) return 0;

    if ($b < 0) return -producto_recursivo($a, -$b);

    return $a + producto_recursivo($a, $b - 1);
}
?>

<?php 

    function validarEdad($edad) {
       if(!is_int($edad)) {
        return false;
       }
 
        if($edad >= 18 && $edad <= 65) {
            return true;
        } else {
            return false;
        }
    }
?>

<?php

function media(...$valores) {
    $cantidad = count($valores);

    if ($cantidad === 0) {
        return null; 
    }

    $suma = array_sum($valores);
    return $suma / $cantidad;
}

?>

<?php

function tiempo($hora, $minuto) {
    $minuto++;

    if ($minuto == 60) {
        $minuto = 0;
        $hora++;
    }

    if ($hora == 24) {
        $hora = 0;
    }

    return [$hora, $minuto];
}

?>
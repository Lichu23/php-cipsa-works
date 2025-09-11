<?php
function serialcheck($cadena) {
    if (!preg_match("/^\d{5}-\d{5}-\d{5}-\d{5}$/", $cadena)) {
        return false;
    }

    $grupos = explode("-", $cadena);

    $g1 = (int)$grupos[0];
    $g2 = (int)$grupos[1];
    $g3 = (int)$grupos[2];
    $g4 = (int)$grupos[3];

    if ($g1 % 2 === 0 &&  
        $g2 % 2 !== 0 &&  
        $g3 % 2 === 0 &&  
        $g4 % 2 !== 0) {  
        return true;
    }

    return false;
}

var_dump(serialcheck("02394-45677-30950-34503")); 
var_dump(serialcheck("12345-67890-12345-67890")); 
var_dump(serialcheck("11111-22222-33333-44444")); 
?>

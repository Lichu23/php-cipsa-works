<?php
function registrarAcceso($usuario) {
    $ip  = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $hora = date('H:i');
    $fecha = date('dmy'); // DDMMYY

    $linea = sprintf("%s,%s,[%s]%s", $usuario, $hora, $ip, PHP_EOL);

    $directorio = __DIR__ . '/logs';
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $archivo = $directorio . "/log" . $fecha . ".log";
        file_put_contents($archivo, $linea, FILE_APPEND | LOCK_EX);
}

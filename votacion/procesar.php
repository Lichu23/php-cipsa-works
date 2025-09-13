<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre    = trim($_POST["nombre"] ?? "");
    $apellidos = trim($_POST["apellidos"] ?? "");
    $dni       = trim($_POST["dni"] ?? "");
    $fecha     = trim($_POST["fecha"] ?? "");
    $candidato = trim($_POST["candidato"] ?? "");

    if ($nombre && $apellidos && $dni && $fecha && $candidato) {
        $registro = [
            "nombre"    => $nombre,
            "apellidos" => $apellidos,
            "dni"       => $dni,
            "fecha"     => $fecha,
            "candidato" => $candidato,
            "fecha_voto"=> date("Y-m-d H:i:s")
        ];

        $archivo = __DIR__ . "/votos.dat";
        file_put_contents($archivo, json_encode($registro) . PHP_EOL, FILE_APPEND);

        echo "<h1>¡Voto registrado correctamente!</h1>";
        echo '<p><a href="index.php">Volver al formulario</a></p>';
        echo '<p><a href="resultados.php">Ver resultados</a></p>';
    } else {
        echo "<h1>Error: todos los campos son obligatorios.</h1>";
        echo '<p><a href="index.php">Volver</a></p>';
    }
} else {
    header("Location: index.php");
    die();
}
 
?>
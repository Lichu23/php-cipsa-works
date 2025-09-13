<?php
$archivo = __DIR__ . "/votos.dat";
$votos = [];

if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        $registro = json_decode($linea, true);
        if ($registro) {
            $votos[] = $registro;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Votación</title>
</head>
<body>
    <h1>Resultados de la Votación</h1>

    <?php if (empty($votos)): ?>
        <p>No se han registrado votos todavía.</p>
    <?php else: ?>
        <table cellpadding="5">
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Fecha Nacimiento</th>
                <th>Candidato</th>
                <th>Fecha Voto</th>
            </tr>
            <?php foreach ($votos as $voto): ?>
                <tr>
                    <td><?= htmlspecialchars($voto["nombre"]) ?></td>
                    <td><?= htmlspecialchars($voto["apellidos"]) ?></td>
                    <td><?= htmlspecialchars($voto["dni"]) ?></td>
                    <td><?= htmlspecialchars($voto["fecha"]) ?></td>
                    <td><?= htmlspecialchars($voto["candidato"]) ?></td>
                    <td><?= htmlspecialchars($voto["fecha_voto"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p><a href="index.php">Volver al formulario</a></p>
</body>
</html>

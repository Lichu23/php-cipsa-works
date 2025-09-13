<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    die();
}

$archivo = __DIR__ . "/votos.dat";
$candidatos = ["Candidato1" => 0, "Candidato2" => 0, "Candidato3" => 0];
$total = 0;

if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        $registro = json_decode($linea, true);
        if ($registro && isset($registro["candidato"])) {
            $cand = $registro["candidato"];
            if (isset($candidatos[$cand])) {
                $candidatos[$cand]++;
                $total++;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Votación</title>
</head>
<body>
    <h1>Resultados de las votaciones</h1>
    <?php if ($total === 0): ?>
        <p>No hay votos registrados aún.</p>
    <?php else: ?>
        <table  cellpadding="5">
            <tr>
                <th>Candidato</th>
                <th>Votos</th>
                <th>Porcentaje</th>
            </tr>
            <?php foreach ($candidatos as $nombre => $votos): 
                $porcentaje = $total > 0 ? round(($votos / $total) * 100, 2) : 0;
            ?>
                <tr>
                    <td><?= htmlspecialchars($nombre) ?></td>
                    <td><?= $votos ?></td>
                    <td><?= $porcentaje ?>%</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <p>Total de votos: <?= $total ?></p>
    <p><a href="cerrar.php">Cerrar sesión</a></p>
</body>
</html>

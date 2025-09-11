<?php
require 'funciones.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Datos de Alumnos</title>
    <style>
        table { border-collapse: collapse; width: 70%; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2, h3 { margin-bottom: 10px; }
    </style>
</head>
<body>

<?php

if (isset($_GET['alumno']) && isset($_GET['asignatura'])) {
    $alumno = buscarAlumno($_GET['alumno']);
    $asig = $_GET['asignatura'];
    if ($alumno && isset($asignaturas[$asig])) {
        echo "<h2>{$alumno['nombre']} {$alumno['apellido1']} {$alumno['apellido2']}</h2>";
        echo "<h3>{$asig} - {$asignaturas[$asig]}</h3>";
        $calificacionesAsignatura = getCalificacionesAlumnoAsignatura($_GET['alumno'], $asig);
        echo "<table><tr><th>Convocatoria</th><th>Calificación</th></tr>";
        foreach ($calificacionesAsignatura as $c) {
            echo "<tr><td>{$c['convocatoria']}</td><td>{$c['calificacion']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Alumno o asignatura no encontrada.</p>";
    }

} elseif (isset($_GET['alumno'])) {

    $alumno = buscarAlumno($_GET['alumno']);
    if ($alumno) {
        echo "<h2>{$alumno['nombre']} {$alumno['apellido1']} {$alumno['apellido2']}</h2>";
        $calificacionesAlumno = getCalificacionesAlumno($_GET['alumno']);
        $asignaturasAlumno = [];
        foreach ($calificacionesAlumno as $c) $asignaturasAlumno[$c['asignatura']][] = $c;
        foreach ($asignaturasAlumno as $clave => $calificacionesAsignatura) {
            echo "<h3>{$clave} - {$asignaturas[$clave]}</h3>";
            echo "<table><tr><th>Convocatoria</th><th>Calificación</th></tr>";
            foreach ($calificacionesAsignatura as $c) {
                echo "<tr><td>{$c['convocatoria']}</td><td>{$c['calificacion']}</td></tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>Alumno no encontrado.</p>";
    }

} elseif (isset($_GET['busqueda'])) {
    $alumnosEncontrados = getAlumnosPorNombre($_GET['busqueda']);
    if (!empty($alumnosEncontrados)) {
        echo "<h2>Alumnos que comienzan con '{$_GET['busqueda']}'</h2>";
        echo "<table><tr><th>Clave</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th></tr>";
        foreach ($alumnosEncontrados as $alumno) {
            $cuenta = $alumno['cuenta'];
            echo "<tr>
                    <td><a href='datos.php?alumno={$cuenta}'>{$cuenta}</a></td>
                    <td>{$alumno['nombre']}</td>
                    <td>{$alumno['apellido1']}</td>
                    <td>{$alumno['apellido2']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron alumnos.</p>";
    }

} elseif (isset($_GET['aprobados'])) {
    $asig = $_GET['aprobados'];
    $conv = $_GET['convocatoria'] ?? null;
    if (!isset($asignaturas[$asig])) { echo "<p>Asignatura no encontrada.</p>"; exit; }
    $aprobados = getAprobados($asig, $conv);
    echo "<h2>{$asig} - {$asignaturas[$asig]}</h2>";
    if ($conv) echo "<p>Hasta convocatoria {$conv}</p>";
    echo "<table><tr><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Convocatoria</th><th>Calificación</th></tr>";
    foreach ($aprobados as $a) {
        echo "<tr><td>{$a['nombre']}</td><td>{$a['apellido1']}</td><td>{$a['apellido2']}</td><td>{$a['convocatoria']}</td><td>{$a['calificacion']}</td></tr>";
    }
    echo "</table>";
    if ($conv) {
        global $alumnos;
        $porcentaje = count($aprobados)/count($alumnos)*100;
        echo "<p>Porcentaje de aprobados hasta convocatoria {$conv}: ".number_format($porcentaje,2)."%</p>";
    }

} elseif (isset($_GET['media'])) {
    $asig = $_GET['media'];
    if (!isset($asignaturas[$asig])) { echo "<p>Asignatura no encontrada.</p>"; exit; }
    $media = mediaAprobados($asig);
    echo "<h2>{$asig} - {$asignaturas[$asig]}</h2>";
    echo "<p>Total alumnos aprobados: {$media['total']}</p>";
    echo "<p>Calificación media: ".number_format($media['media'],2)."</p>";

} elseif (isset($_GET['suspensos'])) {
    $asig = $_GET['suspensos'];
    if (!isset($asignaturas[$asig])) { echo "<p>Asignatura no encontrada.</p>"; exit; }
    $suspensos = getSuspensos($asig);
    echo "<h2>{$asig} - {$asignaturas[$asig]}</h2>";
    if (!empty($suspensos)) {
        echo "<table><tr><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Calificación</th></tr>";
        foreach ($suspensos as $s) {
            $alumno = buscarAlumno($s['cuenta']);
            echo "<tr><td>{$alumno['nombre']}</td><td>{$alumno['apellido1']}</td><td>{$alumno['apellido2']}</td><td>{$s['calificacion']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay suspensos en la sexta convocatoria.</p>";
    }

} else {
    echo "<p>Parámetro no válido o no especificado.</p>";
}

?>

</body>
</html>

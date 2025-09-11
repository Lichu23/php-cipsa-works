<?php
include 'alumnos.php'; // Incluimos los datos

function buscarAlumno($cuenta) {
    global $alumnos;
    foreach ($alumnos as $alumno) {
        if ($alumno['cuenta'] == $cuenta) return $alumno;
    }
    return null;
}

function getCalificacionesAlumno($cuenta) {
    global $calificaciones;
    $result = [];
    foreach ($calificaciones as $c) {
        if ($c['cuenta'] == $cuenta) $result[] = $c;
    }
    return $result;
}

function getCalificacionesAlumnoAsignatura($cuenta, $asignatura) {
    global $calificaciones;
    $result = [];
    foreach ($calificaciones as $c) {
        if ($c['cuenta'] == $cuenta && $c['asignatura'] == $asignatura) $result[] = $c;
    }
    return $result;
}

function getAlumnosPorNombre($inicio) {
    global $alumnos;
    $result = [];
    foreach ($alumnos as $alumno) {
        if (stripos($alumno['nombre'], $inicio) === 0) $result[] = $alumno;
    }
    return $result;
}

function getAprobados($asignatura, $convocatoriaMax = null) {
    global $calificaciones, $alumnos;
    $result = [];
    foreach ($calificaciones as $c) {
        if ($c['asignatura'] == $asignatura && $c['calificacion'] >= 5) {
            if ($convocatoriaMax === null || $c['convocatoria'] <= $convocatoriaMax) {
                $alumno = buscarAlumno($c['cuenta']);
                $result[] = [
                    'nombre' => $alumno['nombre'],
                    'apellido1' => $alumno['apellido1'],
                    'apellido2' => $alumno['apellido2'],
                    'convocatoria' => $c['convocatoria'],
                    'calificacion' => $c['calificacion']
                ];
            }
        }
    }
    usort($result, fn($a,$b)=>$b['calificacion']-$a['calificacion']);
    return $result;
}

function getSuspensos($asignatura) {
    global $calificaciones;
    $result = [];
    foreach ($calificaciones as $c) {
        if ($c['asignatura'] == $asignatura && $c['convocatoria'] == 6 && $c['calificacion'] < 5) {
            $result[] = $c;
        }
    }
    return $result;
}

function mediaAprobados($asignatura) {
    $aprobados = getAprobados($asignatura);
    $total = count($aprobados);
    if ($total == 0) return ['total'=>0,'media'=>0];
    $suma = array_sum(array_column($aprobados,'calificacion'));
    return ['total'=>$total,'media'=>$suma/$total];
}
?>

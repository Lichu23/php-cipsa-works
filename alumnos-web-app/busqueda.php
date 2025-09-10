<?php
require_once "alumnos.php";

if (!isset($_GET['accion'])) {
    header("Location: formulario.html");
    exit;
}

$accion = $_GET['accion'];


function mostrarTabla($alumnos) {
    if (empty($alumnos)) {
        echo "<p>No se encontraron resultados.</p>";
        return;
    }

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Cuenta</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Calificación</th></tr>";
    foreach ($alumnos as $alumno) {
        echo "<tr>";
        echo "<td>{$alumno['cuenta']}</td>";
        echo "<td>{$alumno['nombre']}</td>";
        echo "<td>{$alumno['apellido1']}</td>";
        echo "<td>{$alumno['apellido2']}</td>";
        echo "<td>{$alumno['calificacion']}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

echo "<h1>Resultados</h1>";


if ($accion === "buscar") {
    $filtro = $_GET['filtro'] ?? null;
    $argumento = $_GET['argumento'] ?? '';
    $orden = $_GET['orden'] ?? null;

    $campoFiltro = null;
    switch ($filtro) {
        case 1: $campoFiltro = "nombre"; break;
        case 2: $campoFiltro = "apellido1"; break;
        case 3: $campoFiltro = "apellido2"; break;
        case 4: $campoFiltro = "cuenta"; break;
    }

    $resultado = array_filter($alumnos, function($alumno) use ($campoFiltro, $argumento) {
        return stripos($alumno[$campoFiltro], $argumento) !== false;
    });

    if ($orden) {
        switch ($orden) {
            case 1: $campoOrden = "nombre"; break;
            case 2: $campoOrden = "cuenta"; break;
            case 3: $campoOrden = "calificacion"; break;
        }
        usort($resultado, function($a, $b) use ($campoOrden) {
            return $a[$campoOrden] <=> $b[$campoOrden];
        });
    }

    mostrarTabla($resultado);
}

elseif ($accion === "filtrar") {
    $filtro = $_GET['filtro'] ?? null;
    $valor = $_GET['argumento'] ?? null;

    $resultado = array_filter($alumnos, function($alumno) use ($filtro, $valor) {
        if ($filtro === "mayor") {
            return $alumno['calificacion'] > $valor;
        } elseif ($filtro === "menor") {
            return $alumno['calificacion'] < $valor;
        }
        return false;
    });

    mostrarTabla($resultado);
}

elseif ($accion === "media") {
    $media = array_sum(array_column($alumnos, 'calificacion')) / count($alumnos);
    echo "<p>La calificación media es: <b>" . round($media, 2) . "</b></p>";
}

elseif ($accion === "maximo") {
    $max = max(array_column($alumnos, 'calificacion'));
    $resultado = array_filter($alumnos, fn($a) => $a['calificacion'] == $max);
    mostrarTabla($resultado);
}

elseif ($accion === "minimo") {
    $min = min(array_column($alumnos, 'calificacion'));
    $resultado = array_filter($alumnos, fn($a) => $a['calificacion'] == $min);
    mostrarTabla($resultado);
}

?>

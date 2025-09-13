<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Votacion</title>
</head>
<body>
    <h1>Formulario de Votacion</h1>
    <form method="post" action="procesar.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>
        <br><br>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>
        <br><br>

        <label for="fecha">Fecha de nacimiento:</label>
        <input type="date" id="fecha" name="fecha" required>
        <br><br>

        <p>Seleccione un candidato:</p>
        <input type="radio" id="c1" name="candidato" value="Candidato1" required>
        <label for="c1">Candidato 1</label><br>

        <input type="radio" id="c2" name="candidato" value="Candidato2">
        <label for="c2">Candidato 2</label><br>

        <input type="radio" id="c3" name="candidato" value="Candidato3">
        <label for="c3">Candidato 3</label><br><br>

        <input type="submit" value="Enviar voto">
    </form>
    <p><a href="resultados.php">Ver resultados</a></p>
</body>
</html>

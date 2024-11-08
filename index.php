<!DOCTYPE html>
<html>
<head>
    <title>Notas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <form action="notas.php" method="POST">
            <p><label>Nombre:</label> <input type="text" name="nombre"></p>
            <p><label>DNI:</label> <input type="text" name="dni"></p>
            <p><label>Grupo:</label> <input type="text" name="grupo"></p>
            <p><label>Fecha y Hora:</label> <input type="datetime-local" name="fecha_hora"></p>
            <p><label>Asignatura:</label> <input type="text" name="asignatura"></p>
            <p><label>Nota:</label> <input type="text" name="nota"></p>
            <div>
                <button type="submit" name="nueva">Nueva</button>
                <button type="submit" name="media">Nota Media</button>
                <button type="submit" name="mostrar">Mostrar Usuarios</button>
                <button type="reset" name="cancelar">Limpiar Formulario</button>
            </div>
        </form>
    </div>
</body>
</html>
**************************
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Notas</title>
</head>
<body>
    <h2>Alta de Nueva Nota</h2>
    <form action="notas.php" method="post">
        <input type="hidden" name="accion" value="alta">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="grupo">Grupo:</label>
        <input type="text" id="grupo" name="grupo" required><br>
        <label for="fecha_hora">Fecha y Hora del Examen:</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" required><br>
        <label for="asignatura">Asignatura:</label>
        <input type="text" id="asignatura" name="asignatura" required><br>
        <label for="nota">Nota:</label>
        <input type="number" step="0.01" id="nota" name="nota" required><br>
        <button type="submit">Guardar Nota</button>
    </form>

    <h2>Calcular Nota Media</h2>
    <form action="notas.php" method="post">
        <input type="hidden" name="accion" value="media">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br>
        <label for="asignatura">Asignatura:</label>
        <input type="text" id="asignatura" name="asignatura" required><br>
        <button type="submit">Calcular Nota Media</button>
    </form>
</body>
</html>

<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = obtenerConexion();

    // Obtener los datos del formulario
    $dni = $_POST['dni'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $grupo = $_POST['grupo'] ?? '';
    $fecha_hora = $_POST['fecha_hora'] ?? '';
    $asignatura = $_POST['asignatura'] ?? '';
    $nota = isset($_POST['nota']) ? floatval($_POST['nota']) : null;

    // Alta de una nueva nota
    if (isset($_POST['nueva'])) {
        if ($dni && $nombre && $grupo && $fecha_hora && $asignatura && $nota !== null) {
            $stmt = $conexion->prepare("INSERT INTO registros (dni, nombre, grupo, fecha_hora, asignatura, nota) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssd", $dni, $nombre, $grupo, $fecha_hora, $asignatura, $nota);
            try {
                if ($stmt->execute()) {
                    echo "Nota guardada correctamente.";
                } else {
                    echo "Error al guardar la nota: " . $stmt->error;
                }
            } catch (Exception $e) {
                echo "Error al guardar la nota: " . $e->getMessage();
            }
            $stmt->close();
        } else {
            echo "Por favor, complete todos los campos.";
        }
    }

    // Calcular la nota media
    if (isset($_POST['media'])) {
        if ($dni && $asignatura) {
            $stmt = $conexion->prepare("SELECT AVG(nota) as nota_media FROM notas WHERE dni = ? AND asignatura = ?");
            $stmt->bind_param("ss", $dni, $asignatura);
            $stmt->execute();
            $resultado = $stmt->get_result()->fetch_assoc();
            if ($resultado && $resultado['nota_media'] !== null) {
                echo "La nota media de $nombre en $asignatura es: " . $resultado['nota_media'];
            } else {
                echo "No se encontraron registros para el DNI y asignatura proporcionados.";
            }
            $stmt->close();
        } else {
            echo "Por favor, proporcione el DNI y la asignatura.";
        }
    }

    // Mostrar todos los usuarios
    if (isset($_POST['mostrar'])) {
        $sql = "SELECT DISTINCT dni, nombre, grupo FROM notas";
        $resultado = $conexion->query($sql);
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
        
        if ($usuarios) {
            echo "<h2>Lista de Usuarios Registrados</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Grupo</th>
                    </tr>";
            foreach ($usuarios as $usuario) {
                echo "<tr>
                        <td>{$usuario['dni']}</td>
                        <td>{$usuario['nombre']}</td>
                        <td>{$usuario['grupo']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron usuarios registrados.";
        }
    }

    $conexion->close();
}
?>
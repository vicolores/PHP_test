<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = obtenerConexion();

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
            $sql = "INSERT INTO notas (dni, nombre, grupo, fecha_hora, asignatura, nota) 
                    VALUES (:dni, :nombre, :grupo, :fecha_hora, :asignatura, :nota)";
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute([
                    ':dni' => $dni,
                    ':nombre' => $nombre,
                    ':grupo' => $grupo,
                    ':fecha_hora' => $fecha_hora,
                    ':asignatura' => $asignatura,
                    ':nota' => $nota
                ]);
                echo "Nota guardada correctamente.";
            } catch (PDOException $e) {
                echo "Error al guardar la nota: " . $e->getMessage();
            }
        } else {
            echo "Por favor, complete todos los campos.";
        }
    }

    // Calcular la nota media
    if (isset($_POST['media'])) {
        if ($dni && $asignatura) {
            $sql = "SELECT AVG(nota) as nota_media FROM notas WHERE dni = :dni AND asignatura = :asignatura";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':dni' => $dni,
                ':asignatura' => $asignatura
            ]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado && $resultado['nota_media'] !== null) {
                echo "La nota media de $nombre en $asignatura es: " . $resultado['nota_media'];
            } else {
                echo "No se encontraron registros para el DNI y asignatura proporcionados.";
            }
        } else {
            echo "Por favor, proporcione el DNI y la asignatura.";
        }
    }

    // Mostrar todos los usuarios
    if (isset($_POST['mostrar'])) {
        $sql = "SELECT DISTINCT dni, nombre, grupo FROM notas";
        $stmt = $pdo->query($sql);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
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
}
?>

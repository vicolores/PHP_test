<?php
// Configuración de la base de datos
$servidor = '127.0.0.1'; // Dirección del servidor de la base de datos
$usuario = 'mariadb'; // Nombre de usuario de la base de datos
$contraseña = 'mariadb'; // Contraseña del usuario
$baseDatos = 'mariadb'; // Nombre de la base de datos

// Crear una conexión a la base de datos utilizando MySQLi
$conexion = new mysqli($servidor, $usuario, $contraseña, $baseDatos);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die('Error de conexión (' . $conexion->connect_errno . '): ' . $conexion->connect_error);
}

// Consulta SQL de prueba
$sql = 'SELECT NOW() AS fecha_actual';

// Ejecutar la consulta y obtener el resultado
if ($resultado = $conexion->query($sql)) {
    // Obtener la fila de resultados como un arreglo asociativo
    $fila = $resultado->fetch_assoc();
    echo 'Conexión exitosa. Fecha y hora actual del servidor: ' . $fila['fecha_actual'];
    // Liberar el resultado
    $resultado->free();
} else {
    echo 'Error en la consulta: ' . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>

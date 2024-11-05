<?php
// Configuración de la conexión a la base de datos
$servername = "db"; // Nombre del servicio de base de datos en docker-compose
$username = "mariadb";
$password = "mariadb";
$dbname = "mariadb";

// Crear conexión utilizando mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conectado exitosamente a la base de datos MariaDB";

// Cerrar la conexión
$conn->close();
?>

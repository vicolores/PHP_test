<?php
function obtenerConexion() {
    // Obtener las variables de entorno correctas
    $host = getenv('PGHOST');           // ep-fancy-forest-a5q100h1.us-east-2
    $port = getenv('PGPORT');           // 5432
    $dbname = getenv('PGDATABASE');     // neondb
    $user = getenv('PGUSER');           // neondb_owner
    $password = getenv('PGPASSWORD');   // Contraseña de la base de datos

    // Configuración del DSN para PostgreSQL
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    try {
        // Crear una nueva instancia de PDO para la conexión
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Error de conexión: ' . $e->getMessage());
    }
}
***************************
<?php
function conectarBaseDatos($servidor = '127.0.0.1', $usuario = 'mariadb', $contrasena = 'mariadb', $baseDatos = 'mariadb') {
    $conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}
?>

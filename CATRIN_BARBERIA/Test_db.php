<?php
$host = "127.0.0.1"; 
$user = "root";
$password = "";
$dbname = "barberia_db";

$conn = new mysqli($host, $user, $password, $dbname);

// Muestra detalles del error si la conexión falla
if ($conn->connect_error) {
    die("Error de conexión (" . $conn->connect_errno . "): " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}
?>

<?php
// Configuración de conexión a la base de datos
$host = "127.0.0.1"; 
$user = "root";  
$password = "";  
$dbname = "barberia_db";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $servicio = trim($_POST["servicio"]);
    $barbero = trim($_POST["barbero"]);
    $fecha_hora = trim($_POST["fecha_hora"]);

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($servicio) || empty($barbero) || empty($fecha_hora)) {
        exit("❌ Error: Todos los campos son obligatorios.");
    }

    // Convertir la fecha al formato correcto (YYYY-MM-DD HH:MM:SS)
    $fecha_obj = DateTime::createFromFormat('Y-m-d\TH:i', $fecha_hora);
    if (!$fecha_obj) {
        exit("❌ Error: Formato de fecha y hora inválido.");
    }
    $fecha_hora_formateada = $fecha_obj->format('Y-m-d H:i:s');

    // Generar código de cita único (Ejemplo: CITA-AB1234)
    $codigo_cita = "CITA-" . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO citas (codigo_cita, nombre, servicio, barbero, fecha_hora) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $codigo_cita, $nombre, $servicio, $barbero, $fecha_hora_formateada);

    // Ejecutar consulta y verificar éxito
    if ($stmt->execute()) {
        // Redirigir a la página de confirmación con el código de la cita
        header("Location: confirmacion.php?codigo=" . urlencode($codigo_cita));
        exit(); // Asegúrate de salir del script después de redirigir
    } else {
        echo "❌ Error al guardar la cita: " . $stmt->error;
    }

    // Cerrar conexiones
    $stmt->close();
    $conn->close();
}
?>
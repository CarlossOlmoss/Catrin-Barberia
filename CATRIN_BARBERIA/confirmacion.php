<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="CatrinBarberioLogo.jpeg" alt="Logo de Barbería Catrin Teocal" class="logo">
        <h1>Barbería Catrin Teocal</h1>
    </header>

    <section id="confirmacion">
        <h2>¡Cita Registrada con Éxito!</h2>
        <?php
        if (isset($_GET['codigo'])) {
            $codigo_cita = htmlspecialchars($_GET['codigo']);
            echo "<p>Tu cita ha sido registrada correctamente.</p>";
            echo "<p><strong>Código de cita:</strong> " . $codigo_cita . "</p>";
        } else {
            echo "<p>❌ Error: No se proporcionó un código de cita válido.</p>";
        }
        ?>
        <a href="index.html">Volver al inicio</a>
    </section>

    <footer>
        <p>Contacto: +52 449-344-12-97 | Dirección: Agustin Lara #5, San Miguel, 47200 Teocaltiche, Jal; México.</p>
    </footer>
</body>
</html>
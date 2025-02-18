<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../../login/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campañas</title>
    <link rel="stylesheet" href="stylecam.css">
    <script src="scriptcam.js" defer></script>
</head>
<body>
    <header>
        <h1>Campañas</h1>
        <a href="../home/logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <!-- Menú Principal -->
    <nav class="main-nav">
        <ul>
            <li><a href="../home/home.php">Inicio</a></li>
            <li><a href="campañas.php" class="active">Campañas</a></li>
            <li><a href="../info/info.php">Más Información</a></li> 
            <li><a href="../Administracion/admin.php">Administracion</a></li>
        </ul>
        <form action="buscar.php" method="GET" class="buscador">
            <input type="text" name="query" placeholder="Buscar...">
            <button class="buscar" type="submit">Buscar</button>
        </form>
    </nav>

    <!-- Menú Secundario (Pestañas) -->
    <div class="menu-secundario">
        <button class="tab-btn" onclick="location.href='vistaTLC/vistaTLC.php'">TLC</button>
        <button class="tab-btn" onclick="location.href='vistaMineria/vistaMineria.php'">MINERÍA</button>
        <button class="tab-btn" onclick="location.href='Proyecto_3/YASUNI.php'">YASUNÍ</button>
    </div>

    <!-- Descripción General -->
    <div id="descripcion">
        <h2>Bienvenido a la Sección de Campañas</h2>
        <p>Aquí encontrarás información detallada sobre las distintas campañas de Tegantai.</p>
        <ul>
            <li><strong>TLC:</strong> Información sobre el Tratado de Libre Comercio.</li>
            <li><strong>Minería:</strong> Impacto de la minería en la economía y el medio ambiente.</li>
            <li><strong>Yasuní:</strong> Conservación de la biodiversidad en el Yasuní.</li>
        </ul>
    </div>
</body>
</html>

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
        <h1><img class="logo" src="img/logo-Tegantai.png" alt="Tegantai">Campañas</h1>
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
        <form action="../buscador/buscar.php" method="GET" class="buscador">
            <input type="text" name="query" placeholder="Buscar..." required>
            <button class="buscar" type="submit">Buscar</button>
        </form>
    </nav>

    <!-- Menú Secundario (Pestañas) -->
    <div class="menu-secundario">
        <button class="tab-btn" onclick="location.href='vistaTLC/vistaTLC.php'">TLC</button>
        <button class="tab-btn" onclick="location.href='vistaMineria/vistaMineria.php'">MINERÍA</button>
        <button class="tab-btn" onclick="location.href='vistaYasuni/vistaYasuni.php'">YASUNÍ</button>
    </div>

   <!-- Descripción General -->
<div id="descripcion">
    <h2>Bienvenido a la Sección de Campañas de Tegantai</h2>
    <p>En Tegantai, trabajamos incansablemente para generar conciencia y movilizar acciones que transformen nuestra relación con el medio ambiente y la sociedad. A través de nuestras campañas, buscamos abordar los desafíos más urgentes de la región y promover soluciones sostenibles que beneficien tanto al planeta como a las comunidades que dependen de él.</p>
    
    <p>A continuación, te presentamos algunas de las campañas clave en las que estamos comprometidos:</p>

    <ul>
        <li><strong>TLC (Tratado de Libre Comercio):</strong> <em>Una mirada crítica al impacto del Tratado de Libre Comercio en los ecosistemas y comunidades locales.</em> Analizamos cómo las políticas de comercio internacional afectan directamente la sostenibilidad ambiental y social, proponiendo alternativas para mitigar los efectos negativos.</li>

        <li><strong>Minería:</strong> <em>Exploramos los efectos devastadores de la minería sobre nuestro entorno natural.</em> Desde la degradación de paisajes hasta la contaminación de cuerpos de agua, nuestras campañas buscan generar conciencia sobre la necesidad de prácticas mineras responsables y sustentables.</li>

        <li><strong>Yasuní:</strong> <em>Un santuario de biodiversidad en peligro.</em> El Yasuní es uno de los pulmones más importantes del planeta. A través de nuestra campaña, luchamos por la conservación de este invaluable ecosistema, apoyando proyectos de protección de especies y presionando por políticas que garanticen su preservación a largo plazo.</li>
    </ul>

    <p>Te invitamos a unirte a nuestras campañas y ser parte del cambio. Juntos, podemos proteger lo que más importa: nuestro planeta y las generaciones futuras.</p>
</div>

    <footer>
    <div class="footer-container">
        <div class="footer-logo">
            <img src="img/logo-Tegantai.png" alt="Tegantai">
        </div>

        <div class="footer-contacto">
            <h3>CONTÁCTANOS</h3>
            <p>📧 tegantai@agenciaecologista.info</p>
            <p>📍 Alejandro de Valdéz N34-33 y Av. La Gasca</p>
            <p>📞 3211103 ext 16</p>
        </div>

        <div class="footer-redes">
            <h3>SÍGUENOS EN REDES</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com/agenciategantai"><img src="img/Facebook.png" alt="Facebook"></a>
                <a href="https://x.com/Tegantai"><img src="img/x.png" alt="Twitter"></a>
                <a href="https://www.youtube.com/@AgenciaTegantai"><img src="img/Youtube.png" alt="YouTube"></a>
            </div>
        </div>
    </div>
    <br><p class="footer-copy">&copy; 2025 Agencia Ecologista</p>
</footer>
</body>
</html>

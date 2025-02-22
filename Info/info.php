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
    <title>Más Información</title>
    <link rel="stylesheet" href="styleinfo.css">
    <script src="info.js" defer></script>
</head>
<body>
    <header>
        <h1><img class="logo" src="img/logo-Tegantai.png" alt="Tegantai">Más Información</h1>
        <a href="../home/logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="../home/home.php">Inicio</a></li>
            <li><a href="../campañas/campañas.php">Campañas</a></li>
            <li><a href="info.php" class="active">Más Información</a></li>
            <li><a href="../Administracion/admin.php">Administración</a></li>
        </ul>
        <form action="../buscador/buscar.php" method="GET" class="buscador">
            <input type="text" name="query" placeholder="Buscar..." required>
            <button class="buscar" type="submit">Buscar</button>
        </form>
    
    </nav>

    <div class="menu-secundario">
        <button class="tab-btn active" data-tab="general">General</button>
        <button class="tab-btn" data-tab="detalles">Detalles</button>
    </div>

    <div class="contenedor">
    <div id="general" class="tab-content active">
        <h2><center>Información General<center></h2>
        <div class="card-container">
            <div class="card fade-in">
                <img src="img/naturaleza.jpeg" alt="Imagen de Naturaleza" class="card-img">
                <div class="card-content">
                    <h3>🌍 Nuestra Misión</h3>
                    <p>Proteger y preservar los ecosistemas vulnerables mediante investigaciones científicas, difusión de información y colaboración con comunidades locales.</p>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/datos.jpg" alt="Datos ecológicos" class="card-img">
                <div class="card-content">
                    <h3>📊 Datos Relevantes</h3>
                    <ul>
                        <li>🔹 Más de 200 campañas activas en Latinoamérica.</li>
                        <li>🔹 1.5 millones de hectáreas protegidas en los últimos 5 años.</li>
                        <li>🔹 500 especies documentadas en áreas de conservación.</li>
                    </ul>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/proyectos.jpg" alt="Proyectos Ecológicos" class="card-img">
                <div class="card-content">
                    <h3>💡 Proyectos Destacados</h3>
                    <p>Desde la defensa del Amazonas hasta iniciativas de reciclaje urbano, trabajamos en una variedad de proyectos para reducir el impacto ambiental.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="detalles" class="tab-content">
        <h2><center>Detalles Adicionales<center></h2>
        <div class="card-container">
            <div class="card fade-in">
                <img src="img/comunidad.jpg" alt="Impacto en la Comunidad" class="card-img">
                <div class="card-content">
                    <h3>🌱 Impacto en la Comunidad</h3>
                    <p>Hemos trabajado con más de 150 comunidades indígenas en la conservación de sus territorios, promoviendo el uso sostenible de los recursos naturales.</p>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/datos.jpg" alt="Casos de Éxito" class="card-img">
                <div class="card-content">
                    <h3>📜 Casos de Éxito</h3>
                    <p>Uno de nuestros logros más importantes ha sido la protección de 300,000 hectáreas en la selva amazónica, evitando su deforestación para proyectos extractivos.</p>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/futuro.jpg" alt="Planes a Futuro" class="card-img">
                <div class="card-content">
                    <h3>🚀 Planes a Futuro</h3>
                    <p>Estamos en proceso de expansión con nuevas alianzas internacionales y el desarrollo de tecnología de monitoreo satelital para la protección de áreas naturales.</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <br><br><footer>
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

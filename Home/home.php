<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/index.php");
    exit();
}
$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="stylehome.css">
    <script src="scripthome.js" defer></script>
</head>
<body>
    <header>
        <h1><img class="logo" src="img/logo-Tegantai.png" alt="Tegantai">Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h1>
        <a href="logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="home.php" class="active">Inicio</a></li>
            <li><a href="../Campañas/campañas.php">Campañas</a></li>
            <li><a href="../info/info.php">Más Información</a></li> 
            <li><a href="../Administracion/admin.php">Administración</a></li>

        </ul>
        <form action="../buscador/buscar.php" method="GET" class="buscador">
            <input type="text" name="query" placeholder="Buscar..." required>
            <button class="buscar" type="submit">Buscar</button>
        </form>
    </nav>
    
    <div class="contenido">
    <section class="informacion">
        <h2><center>🌎 Exploración Ecológica</center></h2>
        <div class="card-container">
            <div class="card fade-in">
                <img src="img/naturaleza.jpeg" alt="Imagen de Naturaleza" class="card-img">
                <div class="card-content">
                    <h3>🌍 Naturaleza Viva</h3>
                    <p>Un vistazo a los ecosistemas más impresionantes que estamos protegiendo.</p>
                    <a href="https://es.wikipedia.org/wiki/Naturaleza" target="_blank" class="btn">Descubre más</a>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/video-thumb.jpg" alt="Video sobre Conservación" class="card-img">
                <div class="card-content">
                    <h3>🎥 Video sobre Conservación</h3>
                    <p>¡Mira nuestro último documental sobre las iniciativas de conservación ambiental!</p>
                    <a href="https://www.youtube.com/watch?v=tEnFnbDJLJ8" target="_blank" class="btn">Ver video</a>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/datos.jpg" alt="Datos Ecológicos" class="card-img">
                <div class="card-content">
                    <h3>📊 Datos Impactantes</h3>
                    <ul>
                        <li>🔹 200+ campañas activas en todo el continente.</li>
                        <li>🔹 Más de 1.5 millones de hectáreas protegidas.</li>
                        <li>🔹 500 especies documentadas en áreas de conservación.</li>
                    </ul>
                    <a href="https://www.senderosgr.es/blog/2019/10/02/20-datos-ecologicos-y-medioambientales-que-quizas-no-conocias/" target="_blank" class="btn">Ver más estadísticas</a>
                </div>
            </div>
        </div>
    </section>

    <section class="informacion">
        <h2><center>💡 Iniciativas y Proyectos</center></h2>
        <div class="card-container">
            <div class="card fade-in">
                <img src="img/proyectos.jpg" alt="Proyectos Ecológicos" class="card-img">
                <div class="card-content">
                    <h3>📌 Proyectos Destacados</h3>
                    <p>Desde la defensa del Amazonas hasta iniciativas de reciclaje urbano, trabajamos en una variedad de proyectos.</p>
                    <a href="https://ovacen.com/100-proyectos-ecologicos/" target="_blank" class="btn">Ver proyectos</a>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/comunidad.jpg" alt="Impacto en la Comunidad" class="card-img">
                <div class="card-content">
                    <h3>🌱 Impacto Comunitario</h3>
                    <p>Más de 150 comunidades indígenas trabajando juntos para proteger sus territorios.</p>
                    <a href="https://fastercapital.com/es/contenido/Impacto-comunitario-Empoderar-a-las-comunidades-locales--estrategias-para-lograr-un-impacto-positivo.html" target="_blank" class="btn">Leer más</a>
                </div>
            </div>

            <div class="card fade-in">
                <img src="img/futuro.jpg" alt="Planes a Futuro" class="card-img">
                <div class="card-content">
                    <h3>🚀 Planes para el Futuro</h3>
                    <p>Estamos desarrollando nuevas tecnologías para el monitoreo satelital de áreas naturales.</p>
                    <a href="https://www.plenainclusion.org/familias/planificacion-de-futuro/" target="_blank" class="btn">Descubre nuestros planes</a>
                </div>
            </div>
        </div>
    </section>
</div>

<br>
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

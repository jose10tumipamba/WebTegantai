<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../../login/index.php");
    exit();
}

include '../../Administracion/YASUNI/dbYAS.php';

// Consulta para obtener archivos subidos con su formato
$query = "SELECT a.id, a.nombre, a.conflicto, a.descripcion, a.lugar, a.archivo, a.fecha, f.tipo 
          FROM archivos a 
          LEFT JOIN formatos f ON a.formato_id = f.id";

$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YASUNI</title>
    <link rel="stylesheet" href="../stylecam.css">
</head>
<body>
    <header>
        <h1><img class="logo" src="../img/logo-Tegantai.png" alt="Tegantai">Yasuní</h1>
        <a href="../../home/logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="../../home/home.php">Inicio</a></li>
            <li><a href="../../campañas/campañas.php" class="active">Campañas</a></li>
            <li><a href="../../info/info.php">Más Información</a></li>
            <li><a href="../../Administracion/admin.php">Administración</a></li>
        </ul>
        <form action="buscar.php" method="GET" class="buscador">
            <input type="text" name="query" placeholder="Buscar...">
            <button class="buscar" type="submit">Buscar</button>
        </form>
    </nav>

    <div class="menu-secundario">
        <button class="tab-btn" onclick="location.href='../vistaTLC/vistaTLC.php'">TLC</button>
        <button class="tab-btn" onclick="location.href='../vistaMineria/vistaMineria.php'">MINERÍA</button>
        <button class="tab-btn" onclick="location.href='vistaYasuni.php'">YASUNÍ</button>
    </div>

    <div class="card-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                    <p><strong>Conflicto:</strong> <?php echo htmlspecialchars($row['conflicto']); ?></p>
                    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($row['descripcion']); ?></p>
                    <p><strong>Lugar:</strong> <?php echo htmlspecialchars($row['lugar']); ?></p>
                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($row['fecha']); ?></p>

                    <?php 
                        $ruta = htmlspecialchars($row['archivo']);
                        $tipo = htmlspecialchars($row['tipo']);
                    ?>

                    <!-- Mostrar archivos según su tipo -->
                    <?php if (in_array($tipo, ['imagen', 'video', 'audio', 'documento'])): ?>
                        <?php if ($tipo == 'imagen'): ?>
                            <img src="../../uploads/<?php echo $ruta; ?>" alt="Imagen de <?php echo htmlspecialchars($row['nombre']); ?>" class="media">
                        <?php elseif ($tipo == 'video'): ?>
                            <video controls class="media">
                                <source src="../../uploads/<?php echo $ruta; ?>" type="video/mp4">
                                Tu navegador no soporta la reproducción de video.
                            </video>
                        <?php elseif ($tipo == 'audio'): ?>
                            <audio controls class="media">
                                <source src="../../uploads/<?php echo $ruta; ?>" type="audio/mpeg">
                                Tu navegador no soporta la reproducción de audio.
                            </audio>
                        <?php elseif ($tipo == 'documento'): ?>
                            <a href="../../uploads/<?php echo $ruta; ?>" target="_blank" class="btn">Ver Documento</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="../../uploads/<?php echo $ruta; ?>" target="_blank" class="btn">Descargar Archivo</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay archivos subidos aún.</p>
        <?php endif; ?>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="../img/logo-Tegantai.png" alt="Tegantai">
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
                    <a href="https://www.facebook.com/agenciategantai"><img src="../img/Facebook.png" alt="Facebook"></a>
                    <a href="https://x.com/Tegantai"><img src="../img/x.png" alt="Twitter"></a>
                    <a href="https://www.youtube.com/@AgenciaTegantai"><img src="../img/Youtube.png" alt="YouTube"></a>
                </div>
            </div>
        </div>
        <br>
        <p class="footer-copy">&copy; 2025 Agencia Ecologista</p>
    </footer>
</body>
</html>

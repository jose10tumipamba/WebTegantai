<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../../login/index.php");
    exit();
}

include '../../Administracion/TLC/dbTLC.php';

// Consulta para obtener archivos subidos
$query = "SELECT a.nombre, a.conflicto, a.descripcion, a.lugar, m.ruta, f.tipo 
          FROM archivosTLC a 
          JOIN multimediaTLC m ON a.id = m.archivo_id 
          JOIN formatoTLC f ON m.formato_id = f.id";

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
    <title>TLC</title>
    <link rel="stylesheet" href="../stylecam.css">
</head>
<body>
    <header>
        <h1>Tratado de Libre Comercio</h1>
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
        <button class="tab-btn" onclick="location.href='vistaTLC.php'">TLC</button>
        <button class="tab-btn" onclick="location.href='../Proyecto_2/MINERIA.php'">MINERÍA</button>
        <button class="tab-btn" onclick="location.href='../Proyecto_3/YASUNI.php'">YASUNÍ</button>
    </div>

    <div class="card-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                <p><strong>Conflicto:</strong> <?php echo htmlspecialchars($row['conflicto']); ?></p>
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($row['descripcion']); ?></p>
                <p><strong>Lugar:</strong> <?php echo htmlspecialchars($row['lugar']); ?></p>
                
                <?php 
                    $ruta = htmlspecialchars($row['ruta']);
                    $tipo = pathinfo($ruta, PATHINFO_EXTENSION);
                ?>

                <?php if (in_array($tipo, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])): ?>
                    <img src="../../uploads/<?php echo $ruta; ?>" alt="Imagen" class="media">
                
                <?php elseif (in_array($tipo, ['mp4', 'webm', 'ogg'])): ?>
                    <video controls class="media">
                        <source src="../../uploads/<?php echo $ruta; ?>" type="video/<?php echo $tipo; ?>">
                        Tu navegador no soporta la reproducción de video.
                    </video>

                <?php elseif (in_array($tipo, ['mp3', 'wav', 'ogg'])): ?>
                    <audio controls class="media">
                        <source src="../../uploads/<?php echo $ruta; ?>" type="audio/<?php echo $tipo; ?>">
                        Tu navegador no soporta la reproducción de audio.
                    </audio>

                <?php elseif (in_array($tipo, ['pdf', 'doc', 'docx', 'txt'])): ?>
                    <a href="../../uploads/<?php echo $ruta; ?>" target="_blank" class="btn">Ver Documento</a>

                <?php else: ?>
                    <a href="../../uploads/<?php echo $ruta; ?>" target="_blank" class="btn">Descargar Archivo</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php
include '../Administracion/TLC/dbTLC.php';
include '../Administracion/YASUNI/dbYAS.php';
include '../Administracion/MINERIA/dbMIN.php'; // Conexión a minería

$archivo = null;

// Verificar si se pasaron los parámetros requeridos
if (isset($_GET['id']) && isset($_GET['base'])) {
    $archivo_id = intval($_GET['id']);
    $base = $_GET['base'];

    // Seleccionar la conexión correcta y la carpeta donde buscar archivos
    switch ($base) {
        case "system_mineria":
            $conn = $connMIN;
            $carpeta = "vistaMineria";
            break;
        case "system_tlc":
            $conn = $connTLC;
            $carpeta = "vistaTLC";
            break;
        case "system_yasuni":
            $conn = $connYAS;
            $carpeta = "vistaYasuni";
            break;
        default:
            $conn = null;
            $carpeta = "";
    }

    // Si la conexión es válida, obtener los datos del archivo
    if ($conn) {
        $query = "SELECT nombre, conflicto, descripcion, fecha, lugar, archivo FROM archivos WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $archivo_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $archivo = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Archivo</title>
    <link rel="stylesheet" href="../info/styleinfo.css">
    <script src="../info/info.js" defer></script>
</head>
<body>

<header>
    <h1><img class="logo" src="../info/img/logo-Tegantai.png" alt="Tegantai"> Detalles del Archivo</h1>
    <a href="../home/logout.php" class="logout-btn">Cerrar sesión</a>
</header>

<nav class="main-nav">
    <ul>
        <li><a href="../home/home.php">Inicio</a></li>
        <li><a href="../campañas/campañas.php">Campañas</a></li>
        <li><a href="../info/info.php">Más Información</a></li>
        <li><a href="../Administracion/admin.php">Administración</a></li>
    </ul>
    <form action="../Buscador/buscar.php" method="GET" class="buscador">
        <input type="text" name="query" placeholder="Buscar..." required>
        <button class="buscar" type="submit">Buscar</button>
    </form>
</nav>

<div class="container">
    <h2>Detalles del Archivo</h2>

    <?php if ($archivo): ?>
        <p><strong>📄 Nombre:</strong> <?= htmlspecialchars($archivo['nombre']) ?></p>
        <p><strong>⚠️ Conflicto:</strong> <?= htmlspecialchars($archivo['conflicto']) ?></p>
        <p><strong>📝 Descripción:</strong> <?= htmlspecialchars($archivo['descripcion']) ?></p>
        <p><strong>📅 Fecha:</strong> <?= htmlspecialchars($archivo['fecha']) ?></p>
        <p><strong>📍 Lugar:</strong> <?= htmlspecialchars($archivo['lugar']) ?></p>
        <p><strong>📂 Archivo:</strong> 
            <?php if (!empty($archivo['archivo'])): ?>
                <a href="../Campañas/<?= $carpeta ?>/<?= htmlspecialchars($archivo['archivo']) ?>" target="_blank">🔗 Ver Archivo</a>
            <?php else: ?>
                <span style="color: red;">❌ No hay archivo disponible.</span>
            <?php endif; ?>
        </p>
    <?php else: ?>
        <p style="color: red; text-align: center;">❌ Archivo no encontrado o datos incorrectos.</p>
    <?php endif; ?>

    <a href="javascript:history.back()">⬅️ Volver</a>
</div>

</body>
</html>

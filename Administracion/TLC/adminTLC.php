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
    <title>Administración TLC</title>
    <link rel="stylesheet" href="TLC.css">
    <script src="scriptTLC.js"></script>
</head>
<body>
    <header>
        <h1><img class="logo" src="../img/logo-Tegantai.png" alt="Tegantai">Tratado de Libre Comercio</h1>
        <a href="../../home/logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="../../Home/home.php">Inicio</a></li>
            <li><a href="../../Campañas/campañas.php">Campañas</a></li>
            <li><a href="../../Info/info.php">Más Información</a></li>
            <li><a href="../admin.php" class="active">Administración</a></li>
        </ul>
        <form action="buscar.php" method="GET" class="buscador">
            <input class="buscar1" type="text" name="query" placeholder="Buscar...">
            <button class="buscar" type="submit">Buscar</button>
        </form>
    </nav>

    <div class="menu-secundario">
        <button class="tab-btn" onclick="location.href='adminTLC.php'">TLC</button>
        <button class="tab-btn" onclick="location.href='../MINERIA/adminMIN.php'">MINERÍA</button>
        <button class="tab-btn" onclick="location.href='../YASUNI/adminYAS.php'">YASUNÍ</button>
    </div>

    <main>
        <h2><center>Subir Archivo</center></h2>
        <form id="formSubida" class="formulario-subida" action="subirTLC.php" method="POST" enctype="multipart/form-data" onsubmit="recargarDespuesDeEnviar()">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="conflicto" placeholder="Conflicto" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input type="text" name="lugar" placeholder="Lugar" required>
            <input type="date" name="fecha" required>
            <select name="formato">
                <option value="1">Imagen</option>
                <option value="2">Video</option>
                <option value="3">Audio</option>
                <option value="4">Documento</option>
            </select>
            <input type="file" name="archivo" required>
            <button type="submit" class="boton">Subir Archivo</button>
        </form>
        <p id="mensaje"></p>
        <tbody id="contenidoTabla">
            <?php include 'listarTLC.php'; ?>
        </tbody>
    </main>

    <script src="scriptTLC.js"></script>
</body>
</html>

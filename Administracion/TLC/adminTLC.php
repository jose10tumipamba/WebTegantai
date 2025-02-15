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
        <h1>Administración TLC</h1>
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
        <button class="tab-btn" onclick="location.href='../Pro/MINERIA.php'">MINERÍA</button>
        <button class="tab-btn" onclick="location.href='../Proyecto_3/YASUNI.php'">YASUNÍ</button>
    </div>

    <main>
        <h2><center>Subir Archivo</center></h2>
        <form id="formSubida" class="formulario-subida" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="conflicto" placeholder="Conflicto" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input type="text" name="lugar" placeholder="Lugar" required>
            <input type="date" name="fecha" required>
            <select name="formato">
                <option value="imagen">Imagen</option>
                <option value="video">Video</option>
                <option value="audio">Audio</option>
                <option value="documento">Documento</option>
            </select>
            <input type="file" name="archivo" required>
            <button type="submit" class="boton">Subir Archivo</button>
        </form>

        <p id="mensaje"></p>

        <h3><center>Archivos Subidos</center></h3>
        <table id="tablaArchivos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Conflicto</th>
                    <th>Descripción</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="contenidoTabla">
                <?php include 'listarTLC.php'; ?>
            </tbody>
        </table>
    </main>

</body>
</html>

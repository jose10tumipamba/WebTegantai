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
 
    
</head>
<body>
    <header>
        <h1>Administración TLC</h1>
        <a href="../../home/logout.php" class="logout-btn">Cerrar sesión</a>
    </header>
    <nav class="main-nav">
        <ul>
            <li><a href="../../home/home.php">Inicio</a></li>
            <li><a href="../../Campañas/campañas.php">Campañas</a></li>
            <li><a href="../../info/info.php">Más Información</a></li>
            <li><a href="../../Administracion/admin.php" class="active">Administración</a></li>
        </ul>
       
    </nav>
    <div class="menu-secundario">
        <button class="tab-btn" onclick="location.href='adminTLC.php'">TLC</button>
        <button class="tab-btn" onclick="location.href='../Mineria/adminMineria.php'">MINERÍA</button>
        <button class="tab-btn" onclick="location.href='../Proyecto_3/YASUNI.php'">YASUNÍ</button>
    </div>
<div>
<form action="buscar.php" method="GET" class="buscador">
            <input  type="text" name="query" placeholder="Buscar...">
            <button class="buscar" type="submit">Buscar</button>
        </form>
    <main>
    <h2>Subir Archivo</h2>
    <form action="subirTLC.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="conflicto" placeholder="Conflicto" required>
        <textarea name="descripcion" placeholder="Descripción" required ></textarea>
        <input type="text" name="lugar" placeholder="Lugar" required>
        <input type="text" name="fecha" placeholder="Fecha" required>
        <select name="formato">
            <option value="imagen">Imagen</option>
            <option value="video">Video</option>
            <option value="audio">Audio</option>
            <option value="documento">Documento</option>
        </select>
        <input class="archivo" type="file" name="archivo" required>
        <button class="boton" type="submit">Subir Archivo</button>
    </form>

    <h3>
        Archivos Subidos
    </h3>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Conflicto</th>
            <th>Descripción</th>
            <th>Lugar</th>
            <th>Fecha</th>
            <th>Archivo</th>
            <th>Formato</th>
            <th>Acción</th>
        </tr>
        <?php include 'listarTLC.php'; ?>
    </table>
</main>
</div>

</body>
</html>

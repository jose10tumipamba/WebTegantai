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
    <script src="../scripthome.js" defer></script>
</head>
<body>
    <header>
        <h1>Más Información</h1>
        <a href="../home/logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="../home/home.php">Inicio</a></li>
            <li><a href="../campañas/campañas.php">Campañas</a></li>
            <li><a href="info.php" class="active">Más Información</a></li>
            <li><a href="../Administracion/admin.php">Administración</a></li>
        </ul>
        <form action="buscar.php" method="GET" class="buscador">
            <input type="text" name="query" placeholder="Buscar...">
            <button class="buscar" type="submit">Buscar</button>
        </form>
    </nav>

    <div class="menu-secundario">
        <button class="tab-btn active" data-tab="general">General</button>
        <button class="tab-btn" data-tab="detalles">Detalles</button>
    </div>

    <div class="contenedor">
        <div id="general" class="tab-content active">
            <h2>Información General</h2>
            <p>Contenido de la sección "Más Información".</p>
        </div>
        <div id="detalles" class="tab-content">
            <h2>Detalles Adicionales</h2>
            <p>Aquí puedes incluir más detalles específicos.</p>
        </div>
    </div>

    <script>
        document.querySelectorAll(".tab-btn").forEach(button => {
            button.addEventListener("click", function () {
                document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));
                document.querySelectorAll(".tab-content").forEach(tab => tab.classList.remove("active"));

                this.classList.add("active");
                document.getElementById(this.dataset.tab).classList.add("active");
            });
        });
    </script>
</body>
</html>

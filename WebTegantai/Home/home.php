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
    <script src="../scripthome.js" defer></script>
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h1>
        <a href="logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="home.php" class="active">Inicio</a></li>
            <li><a href="../Campañas/campañas.php">Campañas</a></li>
            <li><a href="../info/info.php">Más Información</a></li> 
            <li><a href="../Administracion/admin.php">Administración</a></li>

        </ul>
        <form action="buscar.php" method="GET" class="buscador">
            <input type="text" name="query" placeholder="Buscar...">
            <button class="buscar" type="submit">Buscar</button>
        </form>
    </nav>

    <div class="contenedor">
        <main class="contenido">
            <p>Selecciona una opción del menú para continuar.</p>
        </main>
    </div>
    
    <div class="contenedor">
        <main class="contenido">
            <p></p>
        </main>
    </div>
</body>
</html>

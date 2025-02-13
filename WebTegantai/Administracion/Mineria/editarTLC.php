<?php
include 'dbTLC.php';
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../../login/index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT a.nombre, a.conflicto, a.descripcion, a.lugar, m.ruta, f.tipo FROM archivosTLC a 
                            JOIN multimediaTLC m ON a.id = m.archivo_id 
                            JOIN formatoTLC f ON m.formato_id = f.id WHERE a.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $archivo = $result->fetch_assoc();
    $stmt->close();
} else {
    header("Location: adminTLC.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $conflicto = trim($_POST["conflicto"]);
    $descripcion = trim($_POST["descripcion"]);
    $lugar = trim($_POST["lugar"]);
    $formato = trim($_POST["formato"]);

    $stmt = $conn->prepare("UPDATE archivosTLC SET nombre=?, conflicto=?, descripcion=?, lugar=? WHERE id=?");
    $stmt->bind_param("ssssi", $nombre, $conflicto, $descripcion, $lugar, $id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("SELECT id FROM formatoTLC WHERE tipo = ?");
    $stmt->bind_param("s", $formato);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $formato_id = $row['id'];
    } else {
        $stmt = $conn->prepare("INSERT INTO formatoTLC (tipo) VALUES (?)");
        $stmt->bind_param("s", $formato);
        $stmt->execute();
        $formato_id = $stmt->insert_id;
    }
    $stmt->close();

    if (!empty($_FILES["archivo"]["name"])) {
        $nombreArchivo = basename($_FILES["archivo"]["name"]);
        $rutaTemporal = $_FILES["archivo"]["tmp_name"];
        $directorioDestino = "uploads/" . $nombreArchivo;
        move_uploaded_file($rutaTemporal, $directorioDestino);

        $stmt = $conn->prepare("UPDATE multimediaTLC SET formato_id=?, ruta=? WHERE archivo_id=?");
        $stmt->bind_param("isi", $formato_id, $directorioDestino, $id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: adminTLC.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Archivo</title>
    <link rel="stylesheet" href="styleTLC.css"> 
</head>
<body>
    <header>
        <h1>Editar Archivo</h1>
        <a href="../../home/logout.php" class="logout-btn">Cerrar sesión</a>
    </header>
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($archivo['nombre']); ?>" required>
            <input type="text" name="conflicto" value="<?php echo htmlspecialchars($archivo['conflicto']); ?>" required>
            <textarea name="descripcion" required><?php echo htmlspecialchars($archivo['descripcion']); ?></textarea>
            <input type="text" name="lugar" value="<?php echo htmlspecialchars($archivo['lugar']); ?>" required>
            <select name="formato">
                <option value="imagen" <?php echo ($archivo['tipo'] == 'imagen') ? 'selected' : ''; ?>>Imagen</option>
                <option value="video" <?php echo ($archivo['tipo'] == 'video') ? 'selected' : ''; ?>>Video</option>
                <option value="audio" <?php echo ($archivo['tipo'] == 'audio') ? 'selected' : ''; ?>>Audio</option>
                <option value="documento" <?php echo ($archivo['tipo'] == 'documento') ? 'selected' : ''; ?>>Documento</option>
            </select>
            <input class="archivo" type="file" name="archivo">
            <button class="boton" type="submit">Guardar Cambios</button>
        </form>
    </main>
</body>
</html>

<?php
include 'dbTLC.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID no válido.");
}

$id = intval($_GET['id']);

// Obtener los datos actuales
$stmt = $conn->prepare("SELECT a.nombre, a.conflicto, a.descripcion, a.lugar, a.fecha, m.ruta, f.tipo 
                        FROM archivosTLC a 
                        JOIN multimediaTLC m ON a.id = m.archivo_id 
                        JOIN formatoTLC f ON m.formato_id = f.id 
                        WHERE a.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Archivo no encontrado.");
}

$archivo = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $conflicto = htmlspecialchars(trim($_POST["conflicto"]));
    $descripcion = htmlspecialchars(trim($_POST["descripcion"]));
    $lugar = htmlspecialchars(trim($_POST["lugar"]));
    $fecha = htmlspecialchars(trim($_POST["fecha"]));
    $formato = htmlspecialchars(trim($_POST["formato"]));

    // Actualizar datos básicos
    $stmt = $conn->prepare("UPDATE archivosTLC SET nombre=?, conflicto=?, descripcion=?, lugar=?, fecha=? WHERE id=?");
    $stmt->bind_param("sssssi", $nombre, $conflicto, $descripcion, $lugar, $fecha, $id);
    $stmt->execute();
    $stmt->close();

    // Si hay un nuevo archivo, lo subimos
    if (!empty($_FILES["archivo"]["name"])) {
        $permitidos = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mp3', 'pdf', 'docx', 'xlsx', 'pptx'];
        $nombreArchivo = basename($_FILES["archivo"]["name"]);
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        if (!in_array($extension, $permitidos)) {
            die("Formato no permitido.");
        }

        $directorioDestino = "uploads/" . uniqid() . "_" . $nombreArchivo;

        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $directorioDestino)) {
            // Eliminar archivo anterior si existe
            if (file_exists($archivo["ruta"])) {
                unlink($archivo["ruta"]);
            }

            // Actualizar en la base de datos
            $stmt = $conn->prepare("UPDATE multimediaTLC SET ruta=? WHERE archivo_id=?");
            $stmt->bind_param("si", $directorioDestino, $id);
            $stmt->execute();
            $stmt->close();
        } else {
            die("Error al subir el nuevo archivo.");
        }
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
    <link rel="stylesheet" href="TLC.css"> 
</head>
<body>
    <header>
        <h1>Editar Archivo</h1>
        <a href="adminTLC.php" class="logout-btn">Volver</a>
    </header>
    <main>
        <section class="formulario-subida">
            <form action="" method="post" enctype="multipart/form-data">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($archivo['nombre']) ?>" required>

                <label>Conflicto:</label>
                <input type="text" name="conflicto" value="<?= htmlspecialchars($archivo['conflicto']) ?>" required>

                <label>Descripción:</label>
                <textarea name="descripcion" required><?= htmlspecialchars($archivo['descripcion']) ?></textarea>

                <label>Lugar:</label>
                <input type="text" name="lugar" value="<?= htmlspecialchars($archivo['lugar']) ?>" required>

                <label>Fecha:</label>
                <input type="date" name="fecha" value="<?= htmlspecialchars($archivo['fecha']) ?>" required>

                <label>Formato:</label>
                <select name="formato">
                    <option value="imagen" <?= $archivo['tipo'] == 'imagen' ? 'selected' : '' ?>>Imagen</option>
                    <option value="video" <?= $archivo['tipo'] == 'video' ? 'selected' : '' ?>>Video</option>
                    <option value="audio" <?= $archivo['tipo'] == 'audio' ? 'selected' : '' ?>>Audio</option>
                    <option value="documento" <?= $archivo['tipo'] == 'documento' ? 'selected' : '' ?>>Documento</option>
                </select>

                <style>
                .icono {
                    width: 50px; /* Ajusta el tamaño según lo necesites */
                    height: 50px;
                    display: block;
                     margin: auto;
                     }
                </style>

                <label>Archivo Actual:</label>
                <td>
                   <a href="<?= htmlspecialchars($archivo['ruta']) ?>" target="_blank">
                        <img src="img/ojo.png" alt='ojo' class='icono'>
                    </a>
                </td>
                <label>Reemplazar Archivo:</label>

                <input type="file" name="archivo">

                <button type="submit">Actualizar</button>
            </form>
        </section>
    </main>
</body>
</html>

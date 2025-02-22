<?php
include 'dbMIN.php';

// Obtener el ID del archivo
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar ID
    $query = "SELECT * FROM archivos WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $archivo = mysqli_fetch_assoc($result);
}

// Obtener los formatos disponibles para el `<select>`
$queryFormatos = "SELECT id, tipo FROM formatos";
$resultFormatos = $conn->query($queryFormatos);

// Si se envía el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $conflicto = mysqli_real_escape_string($conn, $_POST['conflicto']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $lugar = mysqli_real_escape_string($conn, $_POST['lugar']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
    $formato = intval($_POST['formato']); // Obtener el formato seleccionado

    // Comprobar si se subió un nuevo archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        // Obtener el nombre del archivo y su extensión
        $nombreArchivo = $_FILES['archivo']['name'];
        $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        // Verificar que el archivo sea uno permitido
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mp3', 'pdf', 'docx'];
        if (in_array($ext, $extensionesPermitidas)) {
            // Crear un nombre único para el archivo
            $nuevoNombreArchivo = uniqid() . '.' . $ext;

            // Mover el archivo a la carpeta de destino
            $rutaDestino = 'uploads/' . $nuevoNombreArchivo;
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaDestino)) {
                // Eliminar el archivo anterior si existía
                if (!empty($archivo['archivo']) && file_exists('uploads/' . $archivo['archivo'])) {
                    unlink('uploads/' . $archivo['archivo']);
                }

                // Si el archivo se sube correctamente, actualizar la base de datos con el nuevo archivo
                $query = "UPDATE archivos SET nombre=?, conflicto=?, descripcion=?, lugar=?, fecha=?, formato_id=?, archivo=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, 'sssssssi', $nombre, $conflicto, $descripcion, $lugar, $fecha, $formato, $nuevoNombreArchivo, $id);
                if (mysqli_stmt_execute($stmt)) {
                    $mensaje = "¡Actualización exitosa!";
                } else {
                    $mensaje = "Error al actualizar el archivo.";
                }
            } else {
                $mensaje = "Error al subir el archivo.";
            }
        } else {
            $mensaje = "Archivo no permitido.";
        }
    } else {
        // Si no se subió un nuevo archivo, solo actualizamos los demás datos
        $query = "UPDATE archivos SET nombre=?, conflicto=?, descripcion=?, lugar=?, fecha=?, formato_id=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssssssi', $nombre, $conflicto, $descripcion, $lugar, $fecha, $formato, $id);
        if (mysqli_stmt_execute($stmt)) {
            $mensaje = "¡Actualización exitosa!";
        } else {
            $mensaje = "Error al actualizar los datos.";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Archivo</title>
    <link rel="stylesheet" href="MIN.css"> 
</head>
<body>
    <header>
        <h1><img class="logo" src="../img/logo-Tegantai.png" alt="Tegantai">Editar</h1>
        <a href="adminMIN.php" class="logout-btn">Volver</a>
    </header>
    
    <!-- Mostrar mensaje si la actualización fue exitosa o hubo un error -->
    <?php if (isset($mensaje)) { ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
    <?php } ?>

    <!-- HTML para el formulario de edición -->
    <form action="" method="POST" enctype="multipart/form-data" class="formulario-edicion">
        <input type="hidden" name="id" value="<?= $archivo['id'] ?>" class="form-input">
        
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($archivo['nombre']) ?>" required class="form-input">
        
        <label for="conflicto" class="form-label">Conflicto:</label>
        <input type="text" name="conflicto" value="<?= htmlspecialchars($archivo['conflicto']) ?>" required class="form-input">
        
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea name="descripcion" required class="form-textarea"><?= htmlspecialchars($archivo['descripcion']) ?></textarea>
        
        <label for="lugar" class="form-label">Lugar:</label>
        <input type="text" name="lugar" value="<?= htmlspecialchars($archivo['lugar']) ?>" required class="form-input">
        
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="date" name="fecha" value="<?= htmlspecialchars($archivo['fecha']) ?>" required class="form-input">

        <!-- Campo para seleccionar el formato -->
        <label for="formato" class="form-label">Formato:</label>
        <select name="formato" required class="form-select">
            <?php while ($row = $resultFormatos->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>" <?= ($row['id'] == $archivo['formato_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['tipo']) ?>
                </option>
            <?php } ?>
        </select>
        
        
        <button type="submit" class="form-button">Actualizar</button>
    </form>

</body>
</html>

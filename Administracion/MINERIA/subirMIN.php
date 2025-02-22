<?php
include 'dbMIN.php'; // Conectar con la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validación y sanitización de datos
        $nombre = trim($_POST['nombre']);
        $conflicto = trim($_POST['conflicto']);
        $descripcion = trim($_POST['descripcion']);
        $lugar = trim($_POST['lugar']);
        $fecha = trim($_POST['fecha']);

        // Validar el formato_id
        if (!isset($_POST['formato']) || !is_numeric($_POST['formato'])) {
            throw new Exception("Error: Formato inválido.");
        }
        $formato_id = (int)$_POST['formato'];

        // Verificar si el formato_id existe en la base de datos
        $stmtFormato = $conn->prepare("SELECT id FROM formatos WHERE id = ?");
        $stmtFormato->bind_param("i", $formato_id);
        $stmtFormato->execute();
        $resultadoFormato = $stmtFormato->get_result();
        if ($resultadoFormato->num_rows == 0) {
            throw new Exception("Error: El formato seleccionado no es válido.");
        }
        $stmtFormato->close();

        // Validar la subida de archivos
        if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Error: No se subió ningún archivo o hubo un problema.");
        }

        // Verificar tamaño del archivo (5MB límite)
        if ($_FILES['archivo']['size'] > 5 * 1024 * 1024) {
            throw new Exception("Error: El archivo es demasiado grande (Máx: 5MB).");
        }

        // Directorio de almacenamiento
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true)) {
            throw new Exception("Error: No se pudo crear el directorio de almacenamiento.");
        }

        // Obtener detalles del archivo y limpiar el nombre
        $archivo = $_FILES['archivo'];
        $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $nombreArchivo = time() . "_" . preg_replace("/[^a-zA-Z0-9.-]/", "_", pathinfo($archivo['name'], PATHINFO_FILENAME)) . "." . $ext;
        $rutaArchivo = $upload_dir . $nombreArchivo;

        // Validar tipos de archivos permitidos
        $formatos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'mp4', 'mp3'];
        if (!in_array($ext, $formatos_permitidos)) {
            throw new Exception("Error: Tipo de archivo no permitido.");
        }

        // Verificar si el archivo ya existe en la base de datos
        $stmtCheck = $conn->prepare("SELECT id FROM archivos WHERE archivo = ?");
        $stmtCheck->bind_param("s", $rutaArchivo);
        $stmtCheck->execute();
        $resultadoCheck = $stmtCheck->get_result();
        if ($resultadoCheck->num_rows > 0) {
            throw new Exception("Error: El archivo ya existe en la base de datos.");
        }
        $stmtCheck->close();

        // Mover el archivo al directorio de almacenamiento
        if (!move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
            throw new Exception("Error: No se pudo mover el archivo al directorio de almacenamiento.");
        }

        // Insertar en la base de datos con Prepared Statement
        $stmt = $conn->prepare("INSERT INTO archivos (nombre, conflicto, descripcion, archivo, lugar, fecha, formato_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nombre, $conflicto, $descripcion, $rutaArchivo, $lugar, $fecha, $formato_id);
        $stmt->execute();
        $archivo_id = $stmt->insert_id;
        $stmt->close();

        // Registrar la acción en la tabla `acciones`
        $stmtAccion = $conn->prepare("INSERT INTO acciones (archivo_id, accion) VALUES (?, 'crear')");
        $stmtAccion->bind_param("i", $archivo_id);
        $stmtAccion->execute();
        $stmtAccion->close();

       

    } catch (Exception $e) {
        echo htmlspecialchars($e->getMessage()); // Evita XSS en errores
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

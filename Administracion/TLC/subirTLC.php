<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "system_TLC";

$conexion = new mysqli($host, $user, $pass, $dbname);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizar entradas de usuario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $conflicto = mysqli_real_escape_string($conexion, $_POST['conflicto']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $lugar = mysqli_real_escape_string($conexion, $_POST['lugar']);
    $fecha = $_POST['fecha'];
    $formato = $_POST['formato'];

    // Manejo del archivo
    $archivo = $_FILES['archivo']['name'];
    $ruta_temporal = $_FILES['archivo']['tmp_name'];
    $ruta_destino = 'uploads/' . basename($archivo);

    // Validación de tipo de archivo
    $tipos_permitidos = ['image/jpeg', 'image/png', 'application/pdf']; // Tipos permitidos
    $max_tamano = 10 * 1024 * 1024; // Tamaño máximo de archivo en bytes (10MB)
    if (in_array($_FILES['archivo']['type'], $tipos_permitidos)) {
        if ($_FILES['archivo']['size'] <= $max_tamano) {
            if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
                // Usar prepared statements para evitar inyecciones SQL
                $stmt = $conexion->prepare("INSERT INTO archivosTLC (nombre, conflicto, descripcion, lugar, fecha, archivo_ruta) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $nombre, $conflicto, $descripcion, $lugar, $fecha, $ruta_destino);
                if ($stmt->execute()) {
                    $archivo_id = $stmt->insert_id;

                    // Obtener el ID del formato
                    $sql_formato = "SELECT id FROM formatoTLC WHERE tipo = ?";
                    $stmt_formato = $conexion->prepare($sql_formato);
                    $stmt_formato->bind_param("s", $formato);
                    $stmt_formato->execute();
                    $result = $stmt_formato->get_result();

                    if ($result->num_rows > 0) {
                        $formato_id = $result->fetch_assoc()['id'];

                        // Insertar en multimediaTLC
                        $sql_multimedia = "INSERT INTO multimediaTLC (archivo_id, formato_id, ruta) VALUES (?, ?, ?)";
                        $stmt_multimedia = $conexion->prepare($sql_multimedia);
                        $stmt_multimedia->bind_param("iis", $archivo_id, $formato_id, $ruta_destino);
                        if ($stmt_multimedia->execute()) {
                            echo "Archivo subido con éxito.";
                        } else {
                            echo "Error al insertar en multimedia: " . $conexion->error;
                        }
                    } else {
                        echo "Error: Formato no encontrado.";
                    }
                } else {
                    echo "Error al subir el archivo a la base de datos: " . $conexion->error;
                }
            } else {
                echo "Error al mover el archivo. Verifique los permisos de la carpeta de destino.";
            }
        } else {
            echo "El archivo es demasiado grande. El tamaño máximo permitido es " . ($max_tamano / 1024 / 1024) . " MB.";
        }
    } else {
        echo "Tipo de archivo no permitido. Solo se permiten archivos JPEG, PNG o PDF.";
    }
}

$conexion->close();
?>

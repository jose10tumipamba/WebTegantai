<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'system_TLC');
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
        // Insertar en la tabla archivosTLC
        $sql = "INSERT INTO archivosTLC (nombre, conflicto, descripcion, lugar, fecha) 
                VALUES ('$nombre', '$conflicto', '$descripcion', '$lugar', '$fecha')";
        if ($conexion->query($sql) === TRUE) {
            $archivo_id = $conexion->insert_id;

            // Obtener el ID del formato
            $sql_formato = "SELECT id FROM formatoTLC WHERE tipo = '$formato'";
            $result = $conexion->query($sql_formato);
            if ($result->num_rows > 0) {
                $formato_id = $result->fetch_assoc()['id'];

                // Insertar en multimediaTLC
                $sql_multimedia = "INSERT INTO multimediaTLC (archivo_id, formato_id, ruta) 
                                   VALUES ('$archivo_id', '$formato_id', '$ruta_destino')";
                if ($conexion->query($sql_multimedia) === TRUE) {
                    echo "Archivo subido con éxito.";
                } else {
                    echo "Error al insertar en multimedia: " . $conexion->error;
                }
            } else {
                echo "Error: Formato no encontrado.";
            }
        } else {
            echo "Error al subir el archivo: " . $conexion->error;
        }
    } else {
        echo "Error al mover el archivo.";
    }
}

$conexion->close();
?>

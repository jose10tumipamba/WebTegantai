<?php
include 'dbTLC.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $nombre = trim($_POST["nombre"]);
    $conflicto = trim($_POST["conflicto"]);
    $descripcion = trim($_POST["descripcion"]);
    $lugar = trim($_POST["lugar"]);
    $formato = trim($_POST["formato"]);

    if ($_FILES["archivo"]["error"] !== UPLOAD_ERR_OK) {
        die("Error al subir el archivo.");
    }

    $nombreArchivo = basename($_FILES["archivo"]["name"]);
    $rutaTemporal = $_FILES["archivo"]["tmp_name"];
    $directorioDestino = "uploads/" . $nombreArchivo;

    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }
    move_uploaded_file($rutaTemporal, $directorioDestino);

    $stmt = $conn->prepare("INSERT INTO archivosTLC (nombre, conflicto, descripcion, lugar) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $conflicto, $descripcion, $lugar);
    $stmt->execute();
    $archivo_id = $stmt->insert_id;
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

    $stmt = $conn->prepare("INSERT INTO multimediaTLC (archivo_id, formato_id, ruta) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $archivo_id, $formato_id, $directorioDestino);
    $stmt->execute();
    $stmt->close();

    header("Location: adminTLC.php");
    exit();
}
?>

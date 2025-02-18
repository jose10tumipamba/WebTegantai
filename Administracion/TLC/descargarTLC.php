<?php
include 'dbTLC.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID no válido.");
}

$id = intval($_GET['id']);

// Buscar la ruta del archivo
$stmt = $conn->prepare("SELECT ruta FROM multimediaTLC WHERE archivo_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $ruta = $row['ruta'];

    if (file_exists($ruta)) {
        // Obtener el nombre del archivo
        $nombreArchivo = basename($ruta);

        // Forzar la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($ruta));

        readfile($ruta);
        exit;
    } else {
        die("El archivo no existe en el servidor.");
    }
} else {
    die("Archivo no encontrado en la base de datos.");
}

$stmt->close();
$conn->close();
?>

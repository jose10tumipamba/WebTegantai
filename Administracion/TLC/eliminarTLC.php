<?php
include 'dbTLC.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID no válido.");
}

$id = intval($_GET['id']);

// Obtener la ruta del archivo antes de eliminarlo
$stmt = $conn->prepare("SELECT ruta FROM multimediaTLC WHERE archivo_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $ruta = $row['ruta'];

    // Eliminar el archivo del servidor
    if (file_exists($ruta)) {
        unlink($ruta);
    }

    // Eliminar de la base de datos
    $stmt = $conn->prepare("DELETE FROM multimediaTLC WHERE archivo_id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Archivo eliminado con éxito.');
                window.location.href = 'adminTLC.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al eliminar el archivo.');
                window.location.href = 'adminTLC.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Archivo no encontrado.');
            window.location.href = 'adminTLC.php';
          </script>";
}

$stmt->close();
$conn->close();
?>

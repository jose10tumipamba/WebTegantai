<?php
include 'dbTLC.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT ruta FROM multimediaTLC WHERE archivo_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        unlink($row['ruta']); 
    }
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM archivosTLC WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: adminTLC.php");
    exit();
    
}

?>


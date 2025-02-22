<?php
include 'dbTLC.php';

// Verificar si se ha enviado el ID para eliminar
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar ID

    // Eliminar archivo de la base de datos
    $query = "DELETE FROM archivos WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Archivo eliminado correctamente.'); window.location.href = 'adminTLC.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el archivo.'); window.location.href = 'adminTLC.php';</script>";
    }
}

mysqli_close($conn);
?>

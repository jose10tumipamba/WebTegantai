<?php
include 'dbMIN.php'; // Conexión a la base de datos

// Consulta para obtener los archivos con su formato
$query = "SELECT a.id, a.nombre, a.conflicto, a.descripcion, a.lugar, a.fecha, 
                 f.tipo, a.archivo AS ruta    
          FROM archivos a
          LEFT JOIN formatos f ON a.formato_id = f.id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Archivos</title>
    <link rel="stylesheet" href="TLC.css">
    <script src="scriptTLC.js"></script>
</head>
<body>

<table>
    <tr>
        <th>Nombre</th>
        <th>Conflicto</th>
        <th>Descripción</th>
        <th>Lugar</th>
        <th>Fecha</th>
        <th>Formato</th>
        <th>Archivo</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo htmlspecialchars($row['conflicto']); ?></td>
        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
        <td><?php echo htmlspecialchars($row['lugar']); ?></td>
        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
        <td><?php echo htmlspecialchars($row['tipo']); ?></td>
        <td>
            <?php if (!empty($row['ruta'])): ?>
                <a href="<?php echo htmlspecialchars($row['ruta']); ?>" target="_blank">
                    <img src="imgcrud/ojo.png" alt="Ver" class="icono">
                </a>
            <?php else: ?>
                No disponible
            <?php endif; ?>
        </td>
        <td>
            <a href="editarMIN.php?id=<?php echo $row['id']; ?>">
                <img src="imgcrud/editar.png" alt="Editar" class="icono">
            </a> 
            <a href="eliminarMIN.php?id=<?php echo $row['id']; ?>" class="eliminar-btn" onclick="return confirm('¿Eliminar archivo?');">
                <img src="imgcrud/eliminar.png" alt="Eliminar" class="icono">
            </a> 
            <?php if (!empty($row['ruta'])): ?>
                <a href="<?php echo htmlspecialchars($row['ruta']); ?>" download>
                    <img src="imgcrud/descargar.png" alt="Descargar" class="icono">
                </a>
            <?php endif; ?>
        </td>
    </tr>
    <?php } ?>
</table>

<?php mysqli_close($conn); ?>

</body>
</html>

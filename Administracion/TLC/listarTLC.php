<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'system_TLC');
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener los archivos
$sql = "SELECT id, nombre, conflicto, descripcion, lugar, fecha FROM archivosTLC ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['conflicto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lugar']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";

        // Columna de acciones con iconos
        echo "<td>";
        echo "<a href='editarTLC.php?id=" . $row['id'] . "' class='btn'><img src='img/editar.png' alt='Editar' class='icono'></a>";
        echo "<a href='eliminarTLC.php?id=" . $row['id'] . "' onclick='return confirmarEliminacion()' class='btn eliminar-btn'><img src='img/eliminar.png' alt='Eliminar' class='icono'></a>";
        echo "<a href='descargarTLC.php?id=" . $row['id'] . "' class='btn'><img src='img/descargar.png' alt='Descargar' class='icono'></a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No se encontraron archivos.</td></tr>";
}

$conexion->close();
?>
<script>
function confirmarEliminacion() {
    return confirm("¿Estás seguro de que deseas eliminar este archivo?");
}
</script>

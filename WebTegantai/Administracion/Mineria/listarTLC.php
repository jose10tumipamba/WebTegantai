<?php
include 'dbTLC.php';

$result = $conn->query("SELECT a.id, a.nombre, a.conflicto, a.descripcion, a.lugar, m.ruta, f.tipo 
                        FROM archivosTLC a 
                        JOIN multimediaTLC m ON a.id = m.archivo_id 
                        JOIN formatoTLC f ON m.formato_id = f.id");

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['nombre']}</td>
            <td>{$row['conflicto']}</td>
            <td>{$row['descripcion']}</td>
            <td>{$row['lugar']}</td>
            <td>
                <a href='{$row['ruta']}'>
                   <img src='../../Home/img/ojo.png' alt='' class='icono'>
                </a>
            </td>
            <td>{$row['tipo']}</td>
            <td>
                <a href='{$row['ruta']}' download>
                    <img src='../../Home/img/descargar.png' alt='' class='icono'>
                </a>
                <a href='editarTLC.php?id={$row['id']}'>
                    <img src='../../Home/img/editar.png' alt='' class='icono'>
                </a>
                <a href='eliminarTLC.php?id={$row['id']}' onclick='return confirm(\"¿Seguro que deseas eliminar este archivo?\")'>
                    <img src='../../Home/img/eliminar.png' alt='' class='icono'>
                </a>
            </td>
          </tr>";
}
?>

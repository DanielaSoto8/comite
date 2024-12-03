<?php
// Consulta para obtener los datos
$query = "SELECT * FROM informe"; 
$result = mysqli_query($conn, $query);

// Verificar si hay resultados
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['fecha_informe'] . "</td>";
        echo "<td>" . $row['documento_aprendiz'] . "</td>";
        echo "<td>" . $row['nombre_aprendiz'] . "</td>";
        echo "<td>" . $row['correo_aprendiz'] . "</td>";
        echo "<td>" . $row['programa_formacion'] . "</td>";
        echo "<td>" . $row['id_grupo'] . "</td>";
        echo "<td>" . $row['reporte'] . "</td>";

        // Verificar si las claves existen en el array antes de usarlas
        echo "<td>" . (isset($row['documento_instrutor']) ? $row['documento_instrutor'] : 'N/A') . "</td>";
        echo "<td>" . (isset($row['nombre_instrutor']) ? $row['nombre_instrutor'] : 'N/A') . "</td>";
        echo "<td>" . (isset($row['correo_instrutor']) ? $row['correo_instrutor'] : 'N/A') . "</td>";

        echo "<td>" . $row['estado_comite'] . "</td>";
       
        echo "<td>";
        echo "<a href='editar.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm' title='Editar'><i class='fas fa-edit'></i></a> ";
        echo "<a href='eliminar.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' title='Eliminar' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");'><i class='fas fa-trash-alt'></i></a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='12'>No hay datos disponibles</td></tr>";
}
?>


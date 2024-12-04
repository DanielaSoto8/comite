<?php
// Consulta para obtener los datos
$query = "SELECT * FROM informe";
$result = mysqli_query($conn, $query);

// Verificar si hay resultados
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['fecha_informe'] . "</td>";
        echo "<td>" . $row['documento_aprendiz'] . "</td>";
        echo "<td>" . $row['nombre_aprendiz'] . "</td>";
        echo "<td>" . $row['correo_aprendiz'] . "</td>";
        echo "<td>" . $row['programa_formacion'] . "</td>";
        echo "<td>" . $row['id_grupo'] . "</td>";
        echo "<td>" . $row['reporte'] . "</td>";
        echo "<td>" . $row['documento_instructor'] . "</td>";
        echo "<td>" . $row['nombre_instructor'] . "</td>";
        echo "<td>" . $row['correo_instructor'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>
                <button class='btn btn-warning btn-sm btn-editar' data-toggle='modal' data-target='#modalInforme' 
                        data-id='{$row['id']}' 
                        data-fecha_informe='{$row['fecha_informe']}' 
                        data-documento_aprendiz='{$row['documento_aprendiz']}' 
                        data-nombre_aprendiz='{$row['nombre_aprendiz']}' 
                        data-correo_aprendiz='{$row['correo_aprendiz']}' 
                        data-programa_formacion='{$row['programa_formacion']}' 
                        data-id_grupo='{$row['id_grupo']}' 
                        data-reporte='{$row['reporte']}' 
                        data-documento_instructor='{$row['documento_instructor']}'
                        data-nombre_instructor='{$row['nombre_instructor']}'
                        data-correo_instructor='{$row['correo_instructor']}'
                        data-estado='{$row['estado']}'>
                    Editar
                </button> ";
        echo "<button class='btn btn-danger btn-sm' onclick='abrirModalEliminar({$row['id']}, \"{$row['documento_aprendiz']}\")'>
                Eliminar
            </button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='12'>No hay datos disponibles</td></tr>";
}
?>
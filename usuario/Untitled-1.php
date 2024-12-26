 echo "<td>" . $row['fecha_informe'] . "</td>";
        echo "<td>" . $row['documento_aprendiz'] . "</td>";
        echo "<td>" . $row['nombre_aprendiz'] . "</td>";
        echo "<td>" . $row['correo_aprendiz'] . "</td>";
        echo "<td>" . $row['programa_formacion'] . "</td>";
        echo "<td>" . $row['id_grupo'] . "</td>";
        echo "<td>" . $row['reporte'] . "</td>";
        echo "<td>" . (isset($row['documento_instructor']) ? $row['documento_instructor'] : 'N/A') . "</td>";
        echo "<td>" . (isset($row['nombre_instructor']) ? $row['nombre_instructor'] : 'N/A') . "</td>";
        echo "<td>" . (isset($row['correo_instructor']) ? $row['correo_instructor'] : 'N/A') . "</td>";
        echo "<td>" . $row['estado'] . "</td>";

        $fecha_informe && $documento_aprendiz && $nombre_aprendiz && $correo_aprendiz && $programa_formacion && $id_grupo && $reporte && $documento_instructor && $nombre_instructor && $correo_instructor && $estado
<?php
// Verificar si se recibió el parámetro 'id'
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar el ID recibido

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "comite";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener la información del informe
    $sql = "SELECT id, fecha_informe, documento_aprendiz, nombre_aprendiz, correo_aprendiz, programa_formacion, id_grupo, reporte, documento_instructor, nombre_instructor, correo_instructor
            FROM informe WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Generar el PDF
        require_once('../tfpdf/tfpdf.php');

        $pdf = new tFPDF();

        $pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
        $pdf->SetFont('DejaVu','',12);


    
        $pdf->AddPage();
        
        // Definir márgenes
        $pdf->SetMargins(20, 20, 20);

        // Dibuja el marco negro alrededor de la página
        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->Rect(10, 10, 190, 277); // Rectángulo de 190x277mm (A4) con 10mm de margen

        // Logo
        $pdf->Image('../img/sena.png', 20, 15, 15); // Ajusta la ruta y tamaño según tu logo}

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, utf8_decode('SERVICIO NACIONAL DE APRENDIZAJE SENA '), 0, 1, 'C'); 
        $pdf->Ln(5); // Salto de línea

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('CENTRO DE PROCESOS INDUSTRIALES Y DE LA CONSTRUCCION'), 0, 1, 'C'); 
        $pdf->Ln(10); // Salto de línea

        // Título con estilo
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('INFORME PARA COMITE DE EVALUACION Y SEGUIMIENTO'), 0, 1, 'C'); 
        $pdf->Ln(10); // Salto de línea

        // Datos del informe
        $pdf->SetFont('Arial', '', 12);
        
        // Sección Aprendiz
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(0, 10, 'Datos del Aprendiz', 0, 1, 'C', true);
        $pdf->Ln(3);
        $pdf->Cell(50, 10, 'Fecha Informe:', 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, $row['fecha_informe'], 1, 1, 'L'); // Borde
        $pdf->Cell(50, 10, 'Documento Aprendiz:', 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, $row['documento_aprendiz'], 1, 1, 'L'); // Borde
        $pdf->Cell(50, 10, utf8_decode('Nombre Aprendiz:'), 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, utf8_decode($row['nombre_aprendiz']), 1, 1, 'L'); // Borde
        $pdf->Cell(50, 10, 'Correo Aprendiz:', 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, $row['correo_aprendiz'], 1, 1, 'L'); // Borde

        // Sección Programa
        $pdf->Ln(5);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(0, 10, utf8_decode( 'Información del Programa'),0, 1, 'C', true);
        $pdf->Ln(3);
        $pdf->Cell(50, 10, utf8_decode('Programa Formación:'), 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, $row['programa_formacion'], 1, 1, 'L'); // Borde
        $pdf->Cell(50, 10, 'ID Grupo:', 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, $row['id_grupo'], 1, 1, 'L'); // Borde

        // Sección Instructor
        $pdf->Ln(5);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(0, 10, 'Datos del Instructor', 0, 1, 'C', true);
        $pdf->Ln(3);
        $pdf->Cell(50, 10, 'Documento Instructor:', 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, $row['documento_instructor'], 1, 1, 'L'); // Borde
        $pdf->Cell(50, 10, 'Nombre Instructor:',
         1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, utf8_decode($row['nombre_instructor']), 1, 1, 'L'); // Borde
        $pdf->Cell(50, 10, 'Correo Instructor:', 1, 0, 'L'); // Borde
        $pdf->Cell(0, 10, $row['correo_instructor'], 1, 1, 'L'); // Borde
        
        // Sección Reporte
        $pdf->Ln(5);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(0, 10, 'Reporte', 0, 1, 'C', true);
        $pdf->Ln(3);
        $pdf->MultiCell(0, 10, utf8_decode($row['reporte']), 1, 'L'); // Borde

        // Sanitizar nombre y documento para evitar problemas con caracteres especiales en el nombre del archivo
$nombre_aprendiz_limpio = preg_replace('/[^a-zA-Z0-9_]/', '_', $row['nombre_aprendiz']);
$documento_aprendiz_limpio = preg_replace('/[^a-zA-Z0-9_]/', '_', $row['documento_aprendiz']);

// Descargar el PDF con el nombre personalizado
$pdf->Output('D', 'REPORTE_' . $id . '_' . $nombre_aprendiz_limpio . '_' . $documento_aprendiz_limpio . '.pdf');

    } else {
        echo "No se encontró el informe.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID no válido.";
}
?>

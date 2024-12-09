<?php
require_once('../config/config.php');
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['archivo_excel']) && $_FILES['archivo_excel']['error'] == UPLOAD_ERR_OK) {
    $rutaArchivo = $_FILES['archivo_excel']['tmp_name'];

    // Leer el archivo Excel
    $spreadsheet = IOFactory::load($rutaArchivo);
    $hoja = $spreadsheet->getActiveSheet();
    $datos = $hoja->toArray();

    // Conexión a la base de datos
    $conexion = new mysqli($host, $user, $password, $database);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Procesar cada fila (omitir la cabecera)
    for ($i = 1; $i < count($datos); $i++) {
        $fila = $datos[$i];
        $nombres = $fila[0];
        $apellidos = $fila[1];
        $celular = $fila[2];
        $documento = $fila[3];
        $correo = $fila[4];
        $id_grupo = $fila[5];
        $jornada = $fila[6];
        $programa = $fila[7];
        $estado = $fila[8];

        // Insertar en la base de datos
        $stmt = $conexion->prepare("INSERT INTO aprendices (nombres, apellidos, celular, documento, correo_electronico, id_grupo, jornada, programa_formacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssss', $nombres, $apellidos, $celular, $documento, $correo, $id_grupo, $jornada, $programa, $estado);
        $stmt->execute();
    }

    $conexion->close();
    header('Location: aprendiz.php');
    exit();
} else {
    echo "Error al subir el archivo.";
}
?>

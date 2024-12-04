<?php
// Conexión a la base de datos
require_once('../config/config.php');

session_start();
// Verificar si se ha pasado el parámetro 'id' para editar el registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $fecha_informe = $_POST['fecha_informe'];
    $documento_aprendiz = $_POST['documento_aprendiz'];
    $nombre_aprendiz = $_POST['nombre_aprendiz'];
    $correo_aprendiz = $_POST['correo_aprendiz'];
    $programa_formacion = $_POST['programa_formacion'];
    $id_grupo = $_POST['id_grupo'];
    $reporte = $_POST['reporte'];
    $documento_instructor = $_POST['documento_instructor'];
    $nombre_instructor = $_POST['nombre_instructor'];
    $correo_instructor = $_POST['correo_instructor'];
    $estado = $_POST['estado'];

    if (
        $fecha_informe && $documento_aprendiz && $nombre_aprendiz && $correo_aprendiz && $programa_formacion &&
        $id_grupo && $reporte && $documento_instructor && $nombre_instructor && $correo_instructor && $estado
    ) {
        // Actutalizar los datos
        try {
            $update_sql = "UPDATE `informe` SET `fecha_informe`= ?,`documento_aprendiz`= ?,`nombre_aprendiz`= ?,
            `correo_aprendiz`= ?,`programa_formacion`= ?,`id_grupo`= ?,`reporte`= ?,`documento_instructor`= ?,`nombre_instructor`= ?,`correo_instructor`= ?,
            `estado`= ? WHERE id = ? ";
            $update =$pdo->prepare($update_sql);
             $update->execute( [$fecha_informe, $documento_aprendiz, $nombre_aprendiz, $correo_aprendiz, 
            $programa_formacion, $id_grupo, $reporte, $documento_instructor, $nombre_instructor, $correo_instructor, $estado, $id]);

            $_SESSION['mensaje'] = 'Usuario actualizado con éxito';

            // Redirigir al usuario a la página de inicio o cualquier página que desees
            header("Location: informe.php"); // Cambia esta URL por la que desees
            exit;

        } catch (exception $e) {
            $_SESSION['mensaje'] = "Error al actualizar el informe: " . $e->getMessage();
            header("Location: informe.php");
        }

    } else {
        $_SESSION['mensaje'] = "Error: todos los campos son reuqridos: ";
        header("Location: informe.php");
    }
    $update_stmt->close();
} else {
    $_SESSION['mensaje'] = "Error: no se pudo procesar la solicitud: ";
    header("Location: informe.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Informe o Queja</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Registro Aprendiz</h2>

    <?php

      // Incluimos el archivo de procesamiento

    // Definir las variables con valores vacíos
    $Nombres = $Apellidos = $Documento = $correoElectronico = $idGrupo = $Jornada = "";
    $errores = [];

    // Procesar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Nombres"])) {
            $errores['Nombres'] = "El nombre es obligatoria.";
        } else {
            $Nombres = test_input($_POST["Nombres"]);
        }

        if (empty($_POST["Apellidos"])) {
            $errores['Apellidos'] = "El apellido es obligatoria.";
        } else {
            $Apellidos = test_input($_POST["Apellidos"]);
        }

        if (empty($_POST["Documento"])) {
            $errores['Documento'] = "El documento de identidad es obligatorio.";
        } else {
            $Documento = test_input($_POST["Documento"]);
        }

        if (empty($_POST["correoElectronico"])) {
            $errores['correoElectronico'] = "El programa de formación es obligatorio.";
        } else {
            $correoElectronico = test_input($_POST["correoElectronico"]);
        }

        if (empty($_POST["idGrupo"])) {
            $errores['idGrupo'] = "El ID del grupo es obligatorio.";
        } else {
            $idGrupo = test_input($_POST["idGrupo"]);
        }

        if (empty($_POST["Jornada"])) {
            $errores['Jornada'] = "La descripción del informe o queja es obligatoria.";
        } else {
            $Jornada = test_input($_POST["Jornada"]);
        }

        
    }

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>

       

        <!-- Información general -->
        <h4>Información General</h4>
        
        <div class="form-group">
            <label for="Nombres">Nombre del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['Nombres']) ? 'is-invalid' : ''; ?>" id="Nombres" name="Nombres" value="<?php echo $Nombres; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['Nombres'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="Apellidos">Apellidos del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['Apellidos']) ? 'is-invalid' : ''; ?>" id="Apellidos" name="Apellidos" value="<?php echo $Apellidos; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['Apellidos'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="Documento">Documento de identidad del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['Documento']) ? 'is-invalid' : ''; ?>" id="Documento" name="Documento" value="<?php echo $Documento; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['Documento'] ?? ''; ?>
            </div>
        </div>
         <!-- Fecha del informe o queja -->
         <div class="form-group">
            <label for="correoElectronico">Correo Electronico del aprendiz</label>
            <input type="email" class="form-control <?php echo isset($errores['correoElectronico']) ? 'is-invalid' : ''; ?>" id="correoElectronico" name="correoElectronico" value="<?php echo $correoElectronico; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['correoElectronico'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="idGrupo">ID del grupo</label>
            <input type="text" class="form-control <?php echo isset($errores['idGrupo']) ? 'is-invalid' : ''; ?>" id="idGrupo" name="idGrupo" value="<?php echo $idGrupo; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['idGrupo'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="Jornada">Jornada</label>
            <input type="text" class="form-control <?php echo isset($errores['Jornada']) ? 'is-invalid' : ''; ?>" id="Jornada" name="Jornada" value="<?php echo $Jornada; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['Jornada'] ?? ''; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
</form>
    <?php
    include("procesar_formularioAprendices.php");
    ?>
</div>

<!-- Enlace a Bootstrap JS y dependencias -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
</body>
</html>

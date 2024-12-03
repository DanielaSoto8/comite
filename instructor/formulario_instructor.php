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
    <h2>Registro Instructor </h2>

    <?php

      // Incluimos el archivo de procesamiento

    // Definir las variables con valores vacíos
    $documento = $Nombres = $Apellidos =$correo_electronico  = $Estado = "";
    $errores = [];

    // Procesar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["documento"])) {
            $errores['documento'] = "El documento de identidad es obligatorio.";
        } else {
            $documento = test_input($_POST["documento"]);
        }

        if (empty($_POST["nombres"])) {
            $errores['nombres'] = "El nombre es obligatoria.";
        } else {
            $Nombres = test_input($_POST["nombres"]);
        }

        if (empty($_POST["apellidos"])) {
            $errores['Apellidos'] = "El apellido es obligatoria.";
        } else {
            $Apellidos = test_input($_POST["Apellidos"]);
        }
        if (empty($_POST["celular"])) {
            $errores['celular'] = "El documento de identidad es obligatorio.";
        } else {
            $Documento = test_input($_POST["celular"]);
        }
        if (empty($_POST["correo_electronico"])) {
            $errores['correo_electronico'] = "El programa de formación es obligatorio.";
        } else {
            $correo_electronico = test_input($_POST["correo_electronico"]);
        }

        if (empty($_POST["estado"])) {
            $errores['estado'] = "La descripción del informe o queja es obligatoria.";
        } else {
            $Jornada = test_input($_POST["estado"]);
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
            <label for="documento">Documento de identidad del instructor</label>
            <input type="text" class="form-control <?php echo isset($errores['documento']) ? 'is-invalid' : ''; ?>" id="documento" name="documento" value="<?php echo $documento; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['documento'] ?? ''; ?>
            </div>
        </div>
        
        <div class="form-group">
            <label for="nombres">Nombre del Instructor</label>
            <input type="text" class="form-control <?php echo isset($errores['nombres']) ? 'is-invalid' : ''; ?>" id="nombres" name="nombres" value="<?php echo $nombres; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['nombres'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos del Instructor</label>
            <input type="text" class="form-control <?php echo isset($errores['apellidos']) ? 'is-invalid' : ''; ?>" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['apellidos'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="celular">Celular del instructor</label>
            <input type="text" class="form-control <?php echo isset($errores['celular']) ? 'is-invalid' : ''; ?>" id="celular" name="celular" value="<?php echo $celular; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['celular'] ?? ''; ?>
            </div>
        </div>

       
         <!-- Fecha del informe o queja -->
         <div class="form-group">
            <label for="correo_electronico">Correo Electronico del instructor</label>
            <input type="email" class="form-control <?php echo isset($errores['correo_electronico']) ? 'is-invalid' : ''; ?>" id="correo_electronico" name="correo_electronico" value="<?php echo $correo_electronico; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['correo_electronico'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control <?php echo isset($errores['estado']) ? 'is-invalid' : ''; ?>" id="estado" name="estado" value="<?php echo $estado; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['estado'] ?? ''; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
</form>
    <?php
    include("procesar_formulario_instructor.php");
    ?>
</div>

<!-- Enlace a Bootstrap JS y dependencias -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
</body>
</html>

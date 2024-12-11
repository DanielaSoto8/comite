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
    $Nombres = $Apellidos = $tipo_documento = $Documento = $correoElectronico = $idGrupo = $Jornada = "";
    $errores = [];

    // Procesar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        if (empty($_POST["tipo_documento"])) {
            $errores['tipo_documento'] = "El documento de identidad es obligatorio.";
        } else {
            $tipo_documento = test_input($_POST["tipo_documento"]);
        }

        if (empty($_POST["documento"])) {
            $errores['documento'] = "El documento de identidad es obligatorio.";
        } else {
            $Documento = test_input($_POST["documento"]);
        }

        if (empty($_POST["correo_electronico"])) {
            $errores['correo_electronico'] = "El programa de formación es obligatorio.";
        } else {
            $correoElectronico = test_input($_POST["correo_electronico"]);
        }

        if (empty($_POST["id_grupo"])) {
            $errores['id_grupo'] = "El ID del grupo es obligatorio.";
        } else {
            $idGrupo = test_input($_POST["id_grupo"]);
        }

        if (empty($_POST["jornada"])) {
            $errores['jornada'] = "La descripción del informe o queja es obligatoria.";
        } else {
            $Jornada = test_input($_POST["jornada"]);
        }
        if (empty($_POST["programa_formacion"])) {
            $errores['programa_formacion'] = "La descripción del informe o queja es obligatoria.";
        } else {
            $Jornada = test_input($_POST["programa_formacion"]);
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
            <label for="nombres">Nombre del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['nombres']) ? 'is-invalid' : ''; ?>" id="Nombres" name="Nombres" value="<?php echo $Nombres; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['nombres'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['apellidos']) ? 'is-invalid' : ''; ?>" id="Apellidos" name="Apellidos" value="<?php echo $Apellidos; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['apellidos'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="celular">Celular del  aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['celular']) ? 'is-invalid' : ''; ?>" id="Documento" name="Documento" value="<?php echo $Documento; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['celular'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="tipo_documento">Jornada</label>
            <input type="text" class="form-control <?php echo isset($errores['tipo_documento']) ? 'is-invalid' : ''; ?>" id="tipo_documento" name="tipo_documento" value="<?php echo $tipo_documento; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['tipo_documento'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="documento">Documento de identidad del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['documento']) ? 'is-invalid' : ''; ?>" id="Documento" name="Documento" value="<?php echo $Documento; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['documento'] ?? ''; ?>
            </div>
        </div>
         <!-- Fecha del informe o queja -->
         <div class="form-group">
            <label for="correo_electronico">Correo Electronico del aprendiz</label>
            <input type="email" class="form-control <?php echo isset($errores['correo_electronico']) ? 'is-invalid' : ''; ?>" id="correoElectronico" name="correoElectronico" value="<?php echo $correoElectronico; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['correo_electronico'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="id_grupo">ID del grupo</label>
            <input type="text" class="form-control <?php echo isset($errores['id_grupo']) ? 'is-invalid' : ''; ?>" id="idGrupo" name="idGrupo" value="<?php echo $idGrupo; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['id_grupo'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="jornada">Jornada</label>
            <input type="text" class="form-control <?php echo isset($errores['jornada']) ? 'is-invalid' : ''; ?>" id="Jornada" name="Jornada" value="<?php echo $Jornada; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['jornada'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="programa_formacion">Programa formacion</label>
            <input type="text" class="form-control <?php echo isset($errores['programa_formacion']) ? 'is-invalid' : ''; ?>" id="programa_formacion" name="programa_formacion" value="<?php echo $programa_formacion; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['programa_formacion'] ?? ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control <?php echo isset($errores['estado']) ? 'is-invalid' : ''; ?>" id="Jornada" name="Jornada" value="<?php echo $Jornada; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['estado'] ?? ''; ?>
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

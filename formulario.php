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
    <h2>Formulario de Informe o Queja</h2>

    <?php

      // Incluimos el archivo de procesamiento

    // Definir las variables con valores vacíos
    $fechaInforme = $nombreAprendiz = $documentoAprendiz = $programaFormacion = $idGrupo = $descripcionQueja = $testigosPruebas = $correoQuejoso = $nombreQuejoso = $correoDocente = $nombreDocente = "";
    $errores = [];

    // Procesar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["fecha_informe"])) {
            $errores['fechaInforme'] = "La fecha del informe es obligatoria.";
        } else {
            $fechaInforme = test_input($_POST["fecha_informe"]);
        }

        if (empty($_POST["nombre_aprendiz"])) {
            $errores['nombreAprendiz'] = "El nombre del aprendiz es obligatorio.";
        } else {
            $nombreAprendiz = test_input($_POST["nombre_aprendiz"]);
        }

        if (empty($_POST["documento_aprendiz"])) {
            $errores['documentoAprendiz'] = "El documento de identidad es obligatorio.";
        } else {
            $documentoAprendiz = test_input($_POST["documento_aprendiz"]);
        }

        if (empty($_POST["programa_formacion"])) {
            $errores['programaFormacion'] = "El programa de formación es obligatorio.";
        } else {
            $programaFormacion = test_input($_POST["programa_formacion"]);
        }

        if (empty($_POST["id_grupo"])) {
            $errores['idGrupo'] = "El ID del grupo es obligatorio.";
        } else {
            $idGrupo = test_input($_POST["id_grupo"]);
        }

        if (empty($_POST["descripcion_queja"])) {
            $errores['descripcionQueja'] = "La descripción del informe o queja es obligatoria.";
        } else {
            $descripcionQueja = test_input($_POST["descripcion_queja"]);
        }

        if (!empty($_POST["testigos_pruebas"])) {
            $testigosPruebas = test_input($_POST["testigos_pruebas"]);
        }

        if (empty($_POST["correo_quejoso"])) {
            $errores['correoQuejoso'] = "El correo electrónico es obligatorio.";
        } elseif (!filter_var($_POST["correo_quejoso"], FILTER_VALIDATE_EMAIL)) {
            $errores['correoQuejoso'] = "Formato de correo inválido.";
        } else {
            $correoQuejoso = test_input($_POST["correo_quejoso"]);
        }

        if (empty($_POST["nombre_quejoso"])) {
            $errores['nombreQuejoso'] = "El nombre del quejoso es obligatorio.";
        } else {
            $nombreQuejoso = test_input($_POST["nombre_quejoso"]);
        }

        if (empty($_POST["correo_docente"])) {
            $errores['correoDocente'] = "El correo electrónico del docente es obligatorio.";
        } elseif (!filter_var($_POST["correo_docente"], FILTER_VALIDATE_EMAIL)) {
            $errores['correoDocente'] = "Formato de correo inválido.";
        } else {
            $correoDocente = test_input($_POST["correo_docente"]);
        }

        if (empty($_POST["nombre_docente"])) {
            $errores['nombreDocente'] = "El nombre del docente es obligatorio.";
        } else {
            $nombreDocente = test_input($_POST["nombre_docente"]);
        }
    }

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>

        <!-- Fecha del informe o queja -->
        <div class="form-group">
            <label for="fecha_informe">Fecha del informe o queja</label>
            <input type="date" class="form-control <?php echo isset($errores['fechaInforme']) ? 'is-invalid' : ''; ?>" id="fecha_informe" name="fecha_informe" value="<?php echo $fechaInforme; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['fechaInforme'] ?? ''; ?>
            </div>
        </div>

        <!-- Información general -->
        <h4>Información General</h4>
        
        <div class="form-group">
            <label for="nombre_aprendiz">Nombre del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['nombreAprendiz']) ? 'is-invalid' : ''; ?>" id="nombre_aprendiz" name="nombre_aprendiz" value="<?php echo $nombreAprendiz; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['nombreAprendiz'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="documento_aprendiz">Documento de identidad del aprendiz</label>
            <input type="text" class="form-control <?php echo isset($errores['documentoAprendiz']) ? 'is-invalid' : ''; ?>" id="documento_aprendiz" name="documento_aprendiz" value="<?php echo $documentoAprendiz; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['documentoAprendiz'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="programa_formacion">Programa de formación</label>
            <input type="text" class="form-control <?php echo isset($errores['programaFormacion']) ? 'is-invalid' : ''; ?>" id="programa_formacion" name="programa_formacion" value="<?php echo $programaFormacion; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['programaFormacion'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="id_grupo">ID del grupo</label>
            <input type="text" class="form-control <?php echo isset($errores['idGrupo']) ? 'is-invalid' : ''; ?>" id="id_grupo" name="id_grupo" value="<?php echo $idGrupo; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['idGrupo'] ?? ''; ?>
            </div>
        </div>

        <!-- Relación sucinta del informe o queja presentada -->
        <div class="form-group">
            <label for="descripcion_queja">Relación sucinta del informe o de la queja presentada</label>
            <textarea class="form-control <?php echo isset($errores['descripcionQueja']) ? 'is-invalid' : ''; ?>" id="descripcion_queja" name="descripcion_queja" rows="5" required><?php echo $descripcionQueja; ?></textarea>
            <div class="invalid-feedback">
                <?php echo $errores['descripcionQueja'] ?? ''; ?>
            </div>
        </div>

        <!-- Testigos y/o pruebas -->
        <div class="form-group">
            <label for="testigos_pruebas">Testigos y/o pruebas que aporta (opcional)</label>
            <textarea class="form-control" id="testigos_pruebas" name="testigos_pruebas" rows="4"><?php echo $testigosPruebas; ?></textarea>
        </div>

        <!-- Correo electrónico del informante o quejoso -->
        <div class="form-group">
            <label for="correo_quejoso">Correo electrónico del informante o quejoso</label>
            <input type="email" class="form-control <?php echo isset($errores['correoQuejoso']) ? 'is-invalid' : ''; ?>" id="correo_quejoso" name="correo_quejoso" value="<?php echo $correoQuejoso; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['correoQuejoso'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre_quejoso">Nombre del informante o quejoso</label>
            <input type="text" class="form-control <?php echo isset($errores['nombreQuejoso']) ? 'is-invalid' : ''; ?>" id="nombre_quejoso" name="nombre_quejoso" value="<?php echo $nombreQuejoso; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['nombreQuejoso'] ?? ''; ?>
            </div>
        </div>

        <!-- Correo electrónico del docente -->
        <div class="form-group">
            <label for="correo_docente">Correo electrónico del docente</label>
            <input type="email" class="form-control <?php echo isset($errores['correoDocente']) ? 'is-invalid' : ''; ?>" id="correo_docente" name="correo_docente" value="<?php echo $correoDocente; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['correoDocente'] ?? ''; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre_docente">Nombre del docente</label>
            <input type="text" class="form-control <?php echo isset($errores['nombreDocente']) ? 'is-invalid' : ''; ?>" id="nombre_docente" name="nombre_docente" value="<?php echo $nombreDocente; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['nombreDocente'] ?? ''; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    include("procesar_formulario.php");
    ?>
</div>

<!-- Enlace a Bootstrap JS y dependencias -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
</body>
</html>

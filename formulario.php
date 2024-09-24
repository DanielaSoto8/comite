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
    $fechaInforme = $nombreAprendiz = $documentoAprendiz = $programaFormacion = $idGrupo = $descripcionQueja = $testigosPruebas = $correoQuejoso = $nombreQuejoso = "";
    $errores = [];

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
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>

        <!-- 1. Fecha del informe o queja -->
        <div class="form-group">
            <label for="fecha_informe">Fecha del informe o queja</label>
            <input type="date" class="form-control <?php echo isset($errores['fechaInforme']) ? 'is-invalid' : ''; ?>" id="fecha_informe" name="fecha_informe" value="<?php echo $fechaInforme; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['fechaInforme'] ?? ''; ?>
            </div>
        </div>

        <!-- 2. Información general -->
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

        <!-- 3. Relación sucinta del informe o de la queja presentada -->
        <div class="form-group">
            <label for="descripcion_queja">Relación sucinta del informe o de la queja presentada</label>
            <textarea class="form-control <?php echo isset($errores['descripcionQueja']) ? 'is-invalid' : ''; ?>" id="descripcion_queja" name="descripcion_queja" rows="5" required><?php echo $descripcionQueja; ?></textarea>
            <div class="invalid-feedback">
                <?php echo $errores['descripcionQueja'] ?? ''; ?>
            </div>
        </div>

        <!-- 4. Testigos y/o pruebas -->
        <div class="form-group">
            <label for="testigos_pruebas">Testigos y/o pruebas que aporta (opcional)</label>
            <textarea class="form-control" id="testigos_pruebas" name="testigos_pruebas" rows="4"><?php echo $testigosPruebas; ?></textarea>
        </div>

        <!-- 5. Correo electrónico del informante o quejoso -->
        <div class="form-group">
            <label for="correo_quejoso">Correo electrónico del informante o quejoso</label>
            <input type="email" class="form-control <?php echo isset($errores['correoQuejoso']) ? 'is-invalid' : ''; ?>" id="correo_quejoso" name="correo_quejoso" value="<?php echo $correoQuejoso; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['correoQuejoso'] ?? ''; ?>
            </div>
        </div>

        <!-- 6. Nombre del quejoso -->
        <div class="form-group">
            <label for="nombre_quejoso">Nombre del quejoso</label>
            <input type="text" class="form-control <?php echo isset($errores['nombreQuejoso']) ? 'is-invalid' : ''; ?>" id="nombre_quejoso" name="nombre_quejoso" value="<?php echo $nombreQuejoso; ?>" required>
            <div class="invalid-feedback">
                <?php echo $errores['nombreQuejoso'] ?? ''; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enviar Informe</button>
    </form>
    <?php 
    include("procesar_formulario.php");
    ?>
</div>

<!-- Enlace a Bootstrap JS y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

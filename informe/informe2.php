<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Acta</title>
    <link href="../css/ruang-admin.min.css" rel="stylesheet">

    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Formulario de Acta No. 1</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation"
            novalidate>

            <!-- NOMBRE DEL COMITÉ O DE LA REUNIÓN -->
            <div class="form-group">
                <label for="nombre_comite">Nombre del Comité o de la Reunión</label>
                <input type="text" class="form-control" id="nombre_comite" name="nombre_comite" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- CIUDAD Y FECHA -->
            <div class="form-group">
                <label for="ciudad_fecha">Ciudad y Fecha</label>
                <input type="text" class="form-control" id="ciudad_fecha" name="ciudad_fecha" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- HORA DE INICIO Y FIN -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="hora_inicio">Hora de Inicio</label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                    <div class="invalid-feedback">
                        Campo obligatorio.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="hora_fin">Hora Fin</label>
                    <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                    <div class="invalid-feedback">
                        Campo obligatorio.
                    </div>
                </div>
            </div>

            <!-- LUGAR Y CENTRO DE FORMACIÓN -->
            <div class="form-group">
                <label for="lugar">Lugar</label>
                <input type="text" class="form-control" id="lugar" name="lugar" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="centro_formacion">Centro de Formación</label>
                <input type="text" class="form-control" id="centro_formacion" name="centro_formacion" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- TEMAS -->
            <div class="form-group">
                <label for="temas">Temas</label>
                <textarea class="form-control" id="temas" name="temas" rows="3" required></textarea>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- CRITERIOS DE EVALUACIÓN -->
            <div class="form-group">
                <label for="criterios_evaluacion">Criterios de Evaluación</label>
                <textarea class="form-control" id="criterios_evaluacion" name="criterios_evaluacion" rows="3"
                    required></textarea>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- OBJETIVO(S) DE LA REUNIÓN -->
            <div class="form-group">
                <label for="objetivos_reunion">Objetivo(s) de la Reunión</label>
                <textarea class="form-control" id="objetivos_reunion" name="objetivos_reunion" rows="3"
                    required></textarea>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- DESARROLLO DE LA REUNIÓN -->
            <h4>Desarrollo de la Reunión</h4>

            <!-- IDENTIFICACIÓN DEL PLAN DE MEJORAMIENTO -->
            <div class="form-group">
                <label for="fecha_concertacion">Fecha de Concertación</label>
                <input type="date" class="form-control" id="fecha_concertacion" name="fecha_concertacion" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="numero_acta">Número de Acta de Comité</label>
                <input type="text" class="form-control" id="numero_acta" name="numero_acta" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="documento_identidad">Documento aprendiz</label>
                <input type="text" class="form-control" id="documento_aprendiz" name="documento_aprendiz" required
                    autocomplete="off">
                <ul id="sugerencias"
                    class="bg-white border border-gray-300 rounded shadow-lg absolute z-10 hidden max-h-48 overflow-auto">
                </ul>
                <div class="invalid-feedback">Campo obligatorio.</div>
            </div>

            <div class="form-group">
                <label for="nombre_aprendiz">Nombre del Aprendiz</label>
                <input type="text" class="form-control" id="nombre_aprendiz" name="nombre_aprendiz" readonly>
            </div>

            <div class="form-group">
                <label for="correo_aprendiz">Correo del Aprendiz</label>
                <input type="email" class="form-control" id="correo_aprendiz" name="correo_aprendiz" readonly>
            </div>


            <div class="form-group">
                <label for="programa_formacion">Denominación del Programa de Formación</label>
                <input type="text" class="form-control" id="programa_formacion" name="programa_formacion" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="numero_ficha">N° de Ficha (ID) del Programa de Formación</label>
                <input type="text" class="form-control" id="numero_ficha" name="numero_ficha" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="competencia">Competencia</label>
                <input type="text" class="form-control" id="competencia" name="competencia" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="resultados_no_aprobados">Resultados de Aprendizaje No Aprobados</label>
                <textarea class="form-control" id="resultados_no_aprobados" name="resultados_no_aprobados" rows="3"
                    required></textarea>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="duracion_plan">Duración del Plan</label>
                <input type="text" class="form-control" id="duracion_plan" name="duracion_plan" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- FORMULACIÓN DE LAS ACTIVIDADES DE APRENDIZAJE -->
            <div class="form-group">
                <label for="actividades_aprendizaje">Formulación de las Actividades de Aprendizaje</label>
                <textarea class="form-control" id="actividades_aprendizaje" name="actividades_aprendizaje" rows="4"
                    required></textarea>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- EVIDENCIAS DE APRENDIZAJE -->
            <div class="form-group">
                <label for="evidencias_aprendizaje">Evidencias de Aprendizaje</label>
                <textarea class="form-control" id="evidencias_aprendizaje" name="evidencias_aprendizaje" rows="4"
                    required></textarea>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- COMPROMISOS -->
            <h4>Compromisos</h4>

            <div class="form-group">
                <label for="compromisos_actividad">Actividad</label>
                <input type="text" class="form-control" id="compromisos_actividad" name="compromisos_actividad"
                    required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="compromisos_responsable">Responsable</label>
                <input type="text" class="form-control" id="compromisos_responsable" name="compromisos_responsable"
                    required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <div class="form-group">
                <label for="compromisos_fecha">Fecha</label>
                <input type="date" class="form-control" id="compromisos_fecha" name="compromisos_fecha" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <!-- ASISTENTES -->
            <h4>Asistentes</h4>
            <div class="form-group">
                <label for="asistentes">Asistentes (Nombres y Apellidos, Cédula, Tipo de Vinculación,
                    Empresa/Dependencia, Correo Electrónico, Celular/Extensión, Firma)</label>
                <textarea class="form-control" id="asistentes" name="asistentes" rows="5" required></textarea>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <!-- Enlace a Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Función para activar las validaciones de Bootstrap
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        document.getElementById('documento_aprendiz').addEventListener('input', function () {
            const query = this.value;
            if (query.length > 2) {
                fetch(`./buscar_aprendiz.php?documento=${query}`)
                    .then(response => response.json())
                    .then(data => mostrarSugerencias(data))
                    .catch(error => console.error(error));
            } else {
                document.getElementById('sugerencias').classList.add('hidden');
            }
        });

        function mostrarSugerencias(data) {
            const sugerencias = document.getElementById('sugerencias');
            sugerencias.innerHTML = '';
            sugerencias.classList.remove('hidden');
            data.forEach(aprendiz => {
                const li = document.createElement('li');
                li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-100');
                li.textContent = `${aprendiz.documento} - ${aprendiz.nombres}`;
                li.addEventListener('click', function () {
                    document.getElementById('documento_aprendiz').value = aprendiz.documento;
                    document.getElementById('nombre_aprendiz').value = aprendiz.nombres;
                    document.getElementById('correo_aprendiz').value = aprendiz.correo;
                    sugerencias.classList.add('hidden');
                });
                sugerencias.appendChild(li);
            });
        }
    </script>

</body>

</html>
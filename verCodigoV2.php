<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ing. Jose Germán Estrada Clavijo">
    <title>Árbol de Directorios y Código de Archivos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism.min.css">
    <style>
        body {
            margin: 0;
        }

        pre {
            margin: 0;
        }

        ul {
            list-style-type: none;
        }

        ul ul {
            margin-left: 20px;
        }

        .archivo {
            margin-bottom: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .ruta {
            font-size: 0.8em;
            color: #666;
        }

        .directory-tree ul {
            list-style: none;
            padding-left: 20px;
            border-left: 2px solid #333;
        }

        .directory-tree li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 5px;
        }

        .directory-tree li::before {
            content: "";
            position: absolute;
            top: 0;
            left: -12px;
            width: 12px;
            height: 100%;
            border-left: 2px solid #333;
        }

        .directory-tree li:last-child::before {
            height: 50%;
        }

        .directory-tree li strong {
            color: #333;
        }

        .directory-tree li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>

    <?php
    /**
     * @access public
     * @author Ing. Jose Germán Estrada Clavijo <jgestrada@unitecnica.net>
     * @version 2.0
    */

    function mostrarArbolDirectorio($directorio)
    {
        echo "<div class='directory-tree'><ul>";
        $archivos = scandir($directorio);
        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != ".." && $archivo != "verCodigo.php") {
                $ruta_archivo = $directorio . DIRECTORY_SEPARATOR . $archivo;
                echo "<li><strong>$archivo</strong>";
                if (is_dir($ruta_archivo)) {
                    mostrarArbolDirectorio($ruta_archivo);
                }
                echo "</li>";
            }
        }
        echo "</ul></div>";
    }

    echo "<h3>Árbol de Directorios:</h3>";
    mostrarArbolDirectorio(__DIR__);

    echo "<br><br><br><pre><code class='language-php'>";

    function mostrarDirectorio($directorio, $nivel = 0)
    {
        if (!is_dir($directorio)) {
            echo "El directorio no es válido.";
            return;
        }

        $archivos = scandir($directorio);
        echo "<ul>";
        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != ".." && $archivo != "verCodigoV2.php") {
                $ruta_archivo = $directorio . DIRECTORY_SEPARATOR . $archivo;
                echo "<li>";
                for ($i = 0; $i < $nivel; $i++) {
                    echo "-";
                }
                // Muestra el nombre del archivo y su ruta
                echo "<br><br><strong>$archivo</strong> - Ruta: $ruta_archivo <br><br>";
                if (is_dir($ruta_archivo)) {
                    mostrarDirectorio($ruta_archivo, $nivel + 1);
                } else {
                    echo "<pre>" . htmlentities(file_get_contents($ruta_archivo)) . "</pre>";
                }
                echo "</li>";
            }
        }
        echo "</ul>";
    }

    mostrarDirectorio(__DIR__);
    echo "</code></pre>";
    ?>

    <!-- Agregar jsTree al final de la página -->
    <div id="jstree"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script>
        $(function () {
            $('#jstree').jstree({
                'core': {
                    'data': <?php echo json_encode(obtenerArbol(__DIR__)); ?>
                }
            });
        });

        function obtenerArbol($directorio) {
            $arbol = array();
            if (is_dir($directorio)) {
                $archivos = scandir($directorio);
                foreach($archivos as $archivo) {
                    if ($archivo != '.' && $archivo != '..' && $archivo != 'verCodigoV2.php') {
                        $ruta_archivo = $directorio.DIRECTORY_SEPARATOR.$archivo;
                        $nodo = array(
                            'text' => $archivo,
                            'children' => is_dir($ruta_archivo) ? obtenerArbol($ruta_archivo) : array(),
                        );
                        $arbol[] = $nodo;
                    }
                }
            }
            return $arbol;
        }
    </script>

</body>

</html>
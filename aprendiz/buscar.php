<?php
// Definir los valores para la conexión
$servername = "localhost";
$username = "root";  // Usuario de MySQL en XAMPP (por defecto es "root")
$password = "";  // Contraseña de MySQL (por defecto en XAMPP es vacía)
$dbname = "comite";  // Cambia por el nombre de tu base de datos

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el valor de búsqueda de forma segura
$buscar = isset($_GET['buscar']) ? $conn->real_escape_string($_GET['buscar']) : '';

// Solo ejecutar la consulta si hay un valor de búsqueda
if (!empty($buscar)) {
    // Consulta para buscar registros
    $sql = "SELECT * FROM aprendiz 
            WHERE nombres LIKE '%$buscar%' 
            OR apellidos LIKE '%$buscar%' 
            OR celular LIKE '%$buscar%' 
            OR documento LIKE '%$buscar%'
            OR correo_electronico LIKE '%$buscar%' 
            OR id_grupo  LIKE '%$buscar%' 
            OR jornada LIKE '%$buscar%'
            OR programa_formacion LIKE '%$buscar%'
            OR estado LIKE '%$buscar%'";

    $result = $conn->query($sql);

    // Mostrar los resultados con estilo
    echo "<style>
            body {
                font-family: Arial, sans-serif;
            }
            h2 {
                color: green;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th {
                background-color: green;
                color: white;
                padding: 8px;
                text-align: left;
            }
            td {
                border: 1px solid green;
                padding: 8px;
                color: green;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            tr:hover {
                background-color: #e2f7e2;
            }
        </style>";

    echo "<h2>Resultados de la búsqueda</h2>";
    echo "<table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Celular</th>
                    <th>Documento</th>
                    <th>Correo electrónico</th>
                    <th>Id Grupo</th>
                    <th>Jornada</th>
                    <th>Programa de Formación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>";

    if ($result && $result->num_rows > 0) {
        // Mostrar cada registro encontrado
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nombres']}</td>
                    <td>{$row['apellidos']}</td>
                    <td>{$row['celular']}</td>
                    <td>{$row['documento']}</td>
                    <td>{$row['correo_electronico']}</td>
                    <td>{$row['id_grupo']}</td>
                    <td>{$row['jornada']}</td>
                    <td>{$row['programa_formacion']}</td>
                    <td>{$row['estado']}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No se encontraron resultados</td></tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No se proporcionó un valor de búsqueda.</p>";
}

// Cerrar la conexión
$conn->close();
?>

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
    $sql = "SELECT * FROM informes 
            WHERE nombreAprendiz LIKE '%$buscar%' 
            OR documentoAprendiz LIKE '%$buscar%' 
            OR nombreDocente LIKE '%$buscar%' 
            OR idGrupo LIKE '%$buscar%'";

    
    $result = $conn->query($sql);

    // Mostrar los resultados
    echo "<h2>Resultados de la búsqueda</h2>";
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Fecha del Informe</th>
                    <th>Nombre del Aprendiz</th>
                    <th>Documento del Aprendiz</th>
                    <th>Programa de Formación</th>
                    <th>ID del Grupo</th>
                    <th>Descripción de la Queja</th>
                    <th>Testigos/Pruebas</th>
                    <th>Correo del Quejoso</th>
                    <th>Nombre del Quejoso</th>
                    <th>Correo del Docente</th>
                    <th>Nombre del Docente</th>
                </tr>
            </thead>
            <tbody>";

    if ($result && $result->num_rows > 0) {
        // Mostrar cada registro encontrado
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['fechaInforme']}</td>
                    <td>{$row['nombreAprendiz']}</td>
                    <td>{$row['documentoAprendiz']}</td>
                    <td>{$row['programaFormacion']}</td>
                    <td>{$row['idGrupo']}</td>
                    <td>{$row['descripcionQueja']}</td>
                    <td>{$row['testigosPruebas']}</td>
                    <td>{$row['correoQuejoso']}</td>
                    <td>{$row['nombreQuejoso']}</td>
                    <td>{$row['correoDocente']}</td>
                    <td>{$row['nombreDocente']}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No se encontraron resultados</td></tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No se proporcionó un valor de búsqueda.</p>";
}

// Cerrar la conexión
$conn->close();
?>

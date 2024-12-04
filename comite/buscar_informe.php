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
    // Consulta para buscar registros por ID de grupo
    $sql = "SELECT * FROM informe WHERE id_grupo = '$buscar'";

    $result = $conn->query($sql);

    // Mostrar los resultados
    echo "<h2>Resultados de la búsqueda por ID de Grupo</h2>";
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Celular</th>
                    <th>Documento</th>
                    <th>Correo electrónico</th>
                    <th>ID Grupo</th>
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
        echo "<tr><td colspan='9'>No se encontraron resultados para el ID de grupo proporcionado.</td></tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No se proporcionó un valor de búsqueda.</p>";
}

// Cerrar la conexión
$conn->close();
?>

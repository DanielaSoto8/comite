<?php
// Definir los valores para la conexión
$servername = "localhost";
$username = "root";  // Usuario de MySQL en XAMPP (por defecto es "root")
$password = "";  // Contraseña de MySQL (por defecto en XAMPP es vacía)
$dbname = "comite";  // Cambia por el nombre de tu base de datos

// Crear la conexión a la base de datos
$sql = "SELECT * FROM informes WHERE nombreAprendiz LIKE '%$buscar%' OR documentoAprendiz LIKE '%$buscar%' OR idGrupo LIKE '%$buscar%'";

// Ejecutar la consulta
$result = $conn->query($sql);
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el valor de búsqueda
$buscar = $_GET['buscar'];

// Consulta para buscar registros por nombre
$sql = "SELECT * FROM informes WHERE nombreAprendiz, documentoAprendiz, LIKE '%$buscar%'"; // Usamos el campo nombre_aprendiz para la búsqueda
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

if ($result->num_rows > 0) {
    // Mostrar cada registro encontrado
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['fechaInforme'] . "</td>";
        echo "<td>" . $row['nombreAprendiz'] . "</td>";
        echo "<td>" . $row['documentoAprendiz'] . "</td>";
        echo "<td>" . $row['programaFormacion'] . "</td>";
        echo "<td>" . $row['idGrupo'] . "</td>";
        echo "<td>" . $row['descripcionQueja'] . "</td>";
        echo "<td>" . $row['testigosPruebas'] . "</td>";
        echo "<td>" . $row['correoQuejoso'] . "</td>";
        echo "<td>" . $row['nombreQuejoso'] . "</td>";
        echo "<td>" . $row['correoDocente'] . "</td>";
        echo "<td>" . $row['nombreDocente'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11'>No se encontraron resultados</td></tr>";
}

echo "</tbody></table>";

// Cerrar la conexión
$conn->close();
?>

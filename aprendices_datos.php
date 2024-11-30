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

// Consulta para obtener los registros (ajusta esto si es necesario)
$sql = "SELECT * FROM aprendices";
$result = $conn->query($sql);

// Mostrar los resultados en una tabla
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Nombres'] . "</td>";
        echo "<td>" . $row['Apellidos'] . "</td>";
        echo "<td>" . $row['Documento'] . "</td>";
        echo "<td>" . $row['correoElectronico'] . "</td>";
        echo "<td>" . $row['idGrupo'] . "</td>";
        echo "<td>" . $row['Jornada'] . "</td>";
        echo "<td>";
        echo "<a href='editar.php?Documento=" . $row['Documento'] . "' class='btn btn-warning btn-sm' title='Editar'><i class='fas fa-edit'></i></a> ";
        echo "<a href='eliminar.php?Documento=" . $row['Documento'] . "' class='btn btn-danger btn-sm' title='Eliminar' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");'><i class='fas fa-trash-alt'></i></a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11'>No se encontraron registros</td></tr>";
}

// Cerrar la conexión
$conn->close();
?>

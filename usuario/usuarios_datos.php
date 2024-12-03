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
$sql = "SELECT * FROM usuario";
$result = $conn->query($sql);

// Mostrar los resultados en una tabla
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['usuario'] . "</td>";
        echo "<td>" . $row['contrasenia'] . "</td>"; 
        echo "<td>" . $row['nombres'] . "</td>";
        echo "<td>" . $row['apellidos'] . "</td>";
        echo "<td>" . $row['id_perfil'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>";
        echo "<button class='btn btn-warning btn-sm btn-editar' data-toggle='modal' data-target='#modalUsuario' 
                        data-id='{$row['id']}' 
                        data-usuario='{$row['usuario']}' 
                        data-contrasenia='{$row['contrasenia']}' 
                        data-nombres='{$row['nombres']}' 
                        data-apellidos='{$row['apellidos']}' 
                        data-perfil='{$row['id_perfil']}' 
                        data-estado='{$row['estado']}'>
                    Editar
                </button> ";
        echo "<button class='btn btn-danger btn-sm' onclick='abrirModalEliminar({$row['id']}, \"{$row['nombres']}\")'>
                Eliminar
            </button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11'>No se encontraron registros</td></tr>";
}

// Cerrar la conexión
$conn->close();
?>
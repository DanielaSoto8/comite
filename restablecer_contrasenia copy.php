<?php
// Conexión a la base de datos
require_once('./config/config.php');

// Validar el token
$token = $_GET['token'] ?? '';
$query = $conn->prepare("SELECT user_id FROM password_resets WHERE token = ? AND expires_at > NOW()");
$query->bind_param("s", $token);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    die("El enlace ha expirado o es inválido.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userId = $result->fetch_assoc()['user_id'];

    // Actualizar la contraseña
    $query = $conn->prepare("UPDATE usuario SET contrasenia = ? WHERE id = ?");
    $query->bind_param("si", $newPassword, $userId);
    $query->execute();

    // Eliminar el token usado
    $query = $conn->prepare("DELETE FROM password_resets WHERE user_id = ?");
    $query->bind_param("i", $userId);
    $query->execute();

    echo "Contraseña actualizada con éxito.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center text-dark mb-4">Restablecer Contraseña</h3>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="password" class="text-dark">Nueva Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success btn-block">Actualizar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

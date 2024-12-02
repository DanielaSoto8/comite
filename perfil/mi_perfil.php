<?php
// Inicia la sesión
session_start();

// Verifica si el ID de perfil está definido en la sesión
if (isset($_SESSION['perfil'])) {
    // Incluye el archivo de configuración de la base de datos
    require_once(__DIR__ . '/config/config.php');

    try {
        // Prepara y ejecuta la consulta para obtener el nombre del perfil
        $consulta = $pdo->prepare("SELECT perfil FROM perfil WHERE id = ?");
        $consulta->execute([$_SESSION['perfil']]);

        // Verifica si se encontró el perfil
        if ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $perfil = $row['perfil'];
        } else {
            $perfil = 'Perfil no encontrado';
        }
    } catch (PDOException $e) {
        $perfil = 'Error al obtener el perfil: ' . $e->getMessage();
    }
} else {
    $perfil = 'Perfil no definido en la sesión (' . $_SESSION['perfil'] . ")";
}


// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    // Si no está autenticado, redirige a la página de inicio de sesión
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('config/head.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('config/sidebar.php'); ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php include('config/topbar.php'); ?>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <?php include('config/ruta.php'); ?>
                    
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">Mi Perfil</h6>
                                </div>
                                <img class="img" src="img/perfil.jpg" alt="">
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <th>Variable de Sesión</th>
                                            <th>Valor</th>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td><?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'No definido'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Usuario</td>
                                            <td><?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'No definido'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nombres</td>
                                            <td><?php echo isset($_SESSION['nombres']) ? $_SESSION['nombres'] : 'No definido'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Apellidos</td>
                                            <td><?php echo isset($_SESSION['apellidos']) ? $_SESSION['apellidos'] : 'No definido'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Perfil</td>
                                            <td><?php echo $perfil; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Estado</td>
                                            <td><?php echo isset($_SESSION['estado']) ? ($_SESSION['estado'] == 1 ? 'Activo' : 'Inactivo') : 'No definido'; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Logout -->
                        <?php include('config/modalLogOut.php'); ?>

                    </div>
                    <!---Container Fluid-->
                </div>
                <!-- Footer -->
                <?php include('config/footer.php'); ?>
                <!-- Footer -->
            </div>
        </div>

        <!-- Scroll to top -->
        <?php include('config/toTop.php'); ?>
        <?php include('config/scripts.php'); ?>

</body>

</html>
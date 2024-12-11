<!-- 

<?php
// Inicia la sesión (asegúrate de que session_start() esté en todas las páginas protegidas)
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    // Si no está autenticado, redirige a la página de inicio de sesión
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Página de Inicio</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['nombres'] . " " . $_SESSION['apellidos']; ?></h2>
    <p>Este es el contenido de la página de inicio.</p>
    <ul>
        <li><a href="perfil.php">Administrar Perfiles</a></li>
        <li><a href="usuario.php">Administrar Usuarios</a></li>
        <li><a href="mi_perfil.php">Ver mi perfil</a></li>
        <li><a href="op_logout.php">Cerrar Sesión</a></li>
    </ul>
</body>
</html> -->



<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('config/head.php');
    $perfil = $_SESSION['id_perfil'];
    ?>


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
                <div class="container mx-auto mt-4" id="container-wrapper">
                    <?php include('config/ruta.php'); ?>

                    <div class="flex justify-center gap-8 mt-10">
                        <!-- Tarjeta 1 - Instructores -->
                        <?php if ($perfil != 2): ?>
                        <div class="w-60 h-72 bg-green-100 shadow-xl rounded-lg flex flex-col items-center p-4 transition transform hover:scale-105 hover:shadow-2xl cursor-pointer"
                            onclick="window.location.href='../instructor/instructor.php'">
                            <img src="../img/instructor.png" alt="Actas" class="w-32 h-32 mb-4">
                            <p class="text-green-700 font-bold">Instructores</p>
                        </div>
                        <?php endif; ?>
                       
                        <!-- Tarjeta 2 - Aprendices -->
                        <div class="w-60 h-72 bg-green-100 shadow-xl rounded-lg flex flex-col items-center p-4 transition transform hover:scale-105 hover:shadow-2xl cursor-pointer"
                            onclick="window.location.href='../aprendiz/aprendiz.php'">
                            <img src="../img/aprendiz.png" alt="Actas" class="w-32 h-32 mb-4">
                            <p class="text-green-700 font-bold">Aprendices</p>
                        </div>
                       
                        <!-- Tarjeta 3 - Notificación -->
                        <div class="w-60 h-72 bg-green-100 shadow-xl rounded-lg flex flex-col items-center p-4 transition transform hover:scale-105 hover:shadow-2xl cursor-pointer"
                            onclick="window.location.href='../informe/informe.php'">
                            <img src="../img/notificacion1.png" alt="Notificación" class="w-32 h-32 mb-4">
                            <p class="text-green-700 font-bold">Notificación</p>
                        </div> 
                        <?php if ($perfil != 2): ?>
                        <!-- Tarjeta 4 - Agendamiento -->
                        <div class="w-60 h-72 bg-green-100 shadow-xl rounded-lg flex flex-col items-center p-4 transition transform hover:scale-105 hover:shadow-2xl cursor-pointer"
                            onclick="window.location.href='../comite/comite.php'">
                            <img src="../img/agenda.png" alt="Agendamiento" class="w-32 h-32 mb-4">
                            <p class="text-green-700 font-bold">Agendamiento Comite</p>
                        </div>
                        <?php endif; ?>



                    </div>

                </div>


                <!-- Modal Logout -->
                <?php include('config/modalLogOut.php'); ?>

            </div>
            <!---Container Fluid-->
        </div>
        <!-- Footer -->

        <!-- Footer -->
    </div>
    </div>

    <!-- Scroll to top -->
    <?php include('config/toTop.php'); ?>
    <?php include('config/scripts.php'); ?>
    <?php include('config/footer.php'); ?>
    <script>
        // Obtener elementos
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggleTop');
        const contentWrapper = document.getElementById('content-wrapper');

        // Función para alternar el sidebar
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full'); // Mostrar/ocultar sidebar
            contentWrapper.classList.toggle('ml-64'); // Ajustar el contenido cuando se muestra el sidebar
        });
    </script>

</body>

</html>
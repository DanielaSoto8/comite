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
        <div class="container mx-auto mt-4" id="container-wrapper">
                    <?php include('config/ruta.php'); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Notificacion Card -->
                        <div class="col-span-1">
                            <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="card-header bg-green-600 text-white p-4">
                                    <h6 class="font-bold">Notificación</h6>
                                </div>
                                <img class="w-full h-48 object-cover" src="img/notificaciones.png" alt="Notificación">
                                <div class="card-body p-4">
                                    <p>Se registra y notifica al aprendiz que por su desempeño tanto académico o disciplinario no es aprobado.</p>
                                    <button class="btn bg-green-600 text-white py-2 px-4 rounded mt-4">
                                        <a href="./informe/informe.php" class="text-white">Notificaciones</a>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Comites Card -->
                        <div class="col-span-1">
                            <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="card-header bg-green-600 text-white p-4">
                                    <h6 class="font-bold">Comites</h6>
                                </div>
                                <img class="w-full h-48 object-cover" src="img/comites.png" alt="Comites">
                                <div class="card-body p-4">
                                    <p>En este espacio encontrarás las actas de comité efectuadas a los aprendices que, por su bajo rendimiento académico o disciplinario, deben realizar un plan de mejoramiento.</p>
                                    <button class="btn bg-green-600 text-white py-2 px-4 rounded mt-4">
                                        <a href="./comite/comite.php" class="text-white">Agendamiento</a>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Informe Card -->
                        <div class="col-span-1">
                            <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="card-header bg-green-600 text-white p-4">
                                    <h6 class="font-bold">Informe</h6>
                                </div>
                                <img class="w-full h-48 object-cover" src="img/plan.png" alt="Informe">
                                <div class="card-body p-4">
                                    <p>Se implementa un plan de mejoramiento fijando objetivos, actividades y temas vistos en el trimestre, llevando a cabo el método de trabajo, cumpliendo los indicadores propuestos por el instructor.</p>
                                    <button class="btn bg-green-600 text-white py-2 px-4 rounded mt-4">
                                        <a href="./informe/informe.php" class="text-white">Ver plan de mejoramiento</a>
                                    </button>
                                </div>
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
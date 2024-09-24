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
    <h2>Bienvenido, <?php echo $_SESSION['nombres']." ".$_SESSION['apellidos']; ?></h2>
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
        <div class="container-fluid" id="container-wrapper">
          <?php include('config/ruta.php'); ?>

          <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4">
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Notificaciones</h6>
                </div>
                <img  class="img"src="img/notificaciones.png" alt="">
                <div class="card-body">
                    <p>Se notifica al estudiante el reporte por parte del profesor que la competencia
                        no ha sido aprobada
                    </p>
                    <button type="button" class="btn btn-success mb-1"><a href="formulario.php">Notificaciones</a></button>
                   
                    <!-- <button type="button" class="btn btn-secondary mb-1">Secondary</button>
                    <button type="button" class="btn btn-success mb-1">Success</button>
                    <button type="button" class="btn btn-danger mb-1">Danger</button>
                    <button type="button" class="btn btn-warning mb-1">Warning</button>
                    <button type="button" class="btn btn-info mb-1">Info</button>
                    <button type="button" class="btn btn-light mb-1">Light</button>
                    <button type="button" class="btn btn-dark mb-1">Dark</button>
                    <button type="button" class="btn btn-link">Link</button> -->
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Comites</h6>
                </div><!--  -->
                <img  class="img"src="img/comites.png" alt="">
                <div class="card-body">
                    <p>En este espacio encontraras las actas de comite efectuadas a los aprendices que por su bajo rendimiento academico o disciplinario deben de efectuar un plan de mejoramiento para su mejoramiento continuo</p>
                    <button type="button" class="btn btn-success mb-1"><a href="comite.php"></a>Ver Comites</button>
                    
                    <!-- <button type="button" class="btn btn-secondary mb-1">Secondary</button>
                    <button type="button" class="btn btn-success mb-1">Success</button>
                    <button type="button" class="btn btn-danger mb-1">Danger</button>
                  <button type="button" class="btn btn-warning mb-1">Warning</button>
                  <button type="button" class="btn btn-info mb-1">Info</button>
                  <button type="button" class="btn btn-light mb-1">Light</button>
                  <button type="button" class="btn btn-dark mb-1">Dark</button>
                  <button type="button" class="btn btn-link">Link</button> -->
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4">
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Plan de Mejoramiento</h6>
                </div>
                <img class="img"  src="img/plan.png" alt="">
                <div class="card-body">
                  <p> se immplementa plan de mejoramiento fijando objetivos, actividades y temas vistos en el trimestre,llevando a  cabo el método de trabajo,
                     cumpliendo los indicadores propuestos por el instructor</p>
                  <button type="button" class="btn btn-success mb-1"><a href="plan_de_mejoramiento.php">Ver plan de mejoramiento</a></button>
                  
                  <!-- <button type="button" class="btn btn-secondary mb-1">Secondary</button>
                  <button type="button" class="btn btn-success mb-1">Success</button>
                  <button type="button" class="btn btn-danger mb-1">Danger</button>
                  <button type="button" class="btn btn-warning mb-1">Warning</button>
                  <button type="button" class="btn btn-info mb-1">Info</button>
                  <button type="button" class="btn btn-light mb-1">Light</button>
                  <button type="button" class="btn btn-dark mb-1">Dark</button>
                  <button type="button" class="btn btn-link">Link</button> -->
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

</body>

</html>


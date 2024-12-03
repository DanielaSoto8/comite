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
                    <!-- Aquí irá el contenido dinámico -->
                    <?php include('../instructor/instructor.php'); ?>
                </div>
                <!-- Container Fluid-->
            </div>
            <!-- Footer -->
            <?php include('config/footer.php'); ?>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <?php include('../config/toTop.php'); ?>
    <?php include('../config/scripts.php'); ?>
</body>
</html>

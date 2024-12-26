<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body id="page-top" class="bg-gray-100 flex">

    <!-- Wrapper -->
    <div id="wrapper" class="flex flex-row w-full">

        <!-- Sidebar -->
        <?php include('config/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex flex-col w-full ml-0 transition-all duration-300 ease-in-out" id="content-wrapper">
            <div id="content" class="flex-1 bg-white p-6">

                <!-- Topbar -->
                <?php include('config/topbar.php'); ?>

                <!-- Main Content -->
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
            </div>
        </div>
    </div>

    <!-- JavaScript para manejar el sidebar -->
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

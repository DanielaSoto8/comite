<?php
// Verifica si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado y tiene los datos necesarios
if (!isset($_SESSION['nombres']) || !isset($_SESSION['apellidos'])) {
    $_SESSION['nombres'] = 'Usuario'; // Valor por defecto
}
?>

<nav class="bg-green-600 text-white flex items-center justify-between p-4 w-full">
    <!-- Sidebar Toggle Button (Hamburger) -->
    <button id="sidebarToggleTop" class="text-white text-2xl">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Brand Text -->
    <div class="text-3xl font-semibold">EduComitPro</div>

    <!-- User Profile -->
    <ul class="flex items-center space-x-4">
        <li class="relative">
            <a href="#" class="text-white text-lg flex items-center space-x-2" id="userMenuButton">
                <img src="../img/boy.png" alt="Profile Picture" class="w-8 h-8 rounded-full">
                <span class="hidden lg:inline text-sm">
                    <?php echo htmlspecialchars($_SESSION['nombres'] . ' ' . $_SESSION['apellidos']); ?>
                </span>
            </a>
            <!-- Menú desplegable -->
            <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden">
                <ul class="py-2">
                    <li>
                        <a href="mi_perfil.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hidden">Mi Perfil</a>
                    </li>
                    <li>
                        <a href="../op_logout.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>

<script>
    // Toggle del menú
    document.getElementById('userMenuButton').addEventListener('click', function (event) {
        event.preventDefault();
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
    });

    // Cierra el menú al hacer clic fuera de él
    document.addEventListener('click', function (event) {
        const menu = document.getElementById('userMenu');
        const button = document.getElementById('userMenuButton');
        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>

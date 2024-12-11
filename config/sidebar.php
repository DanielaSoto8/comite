<!-- sidebar.php -->
<?php
$perfil = $_SESSION['id_perfil'];
?>
<div id="sidebar"
    class="bg-green-600 text-white w-64 h-full fixed left-0 top-0 p-4 transform -translate-x-full transition-all duration-300 ease-in-out">
    <a href="" class="text-xl font-semibold text-center text-white"></a><img src="../img/logo/sena.png" alt="">
    <ul class="space-y-2 mt-4">
        <?php if ($perfil != 2): ?>
            <li><a href="../usuario/usuario.php" class="text-white hover:bg-green-600 p-2 rounded">Administrar Usuarios</a>
            </li>
            <li><a href="../instructor/instructor.php" class="text-white hover:bg-green-600 p-2 rounded">Administrar
                    Instructores</a></li>
            <li><a href="../comite/comite.php" class="text-white hover:bg-green-600 p-2 rounded">Agendamiento Comite</a>
            </li>
        <?php endif; ?>
        <li><a href="../Aprendiz/aprendiz.php" class="text-white hover:bg-green-600 p-2 rounded">Administrar
                Aprendices</a></li>
        <li><a href="../informe/informe.php" class="text-white hover:bg-green-600 p-2 rounded">Notificaciones</a></li>
        </li>
    </ul>
</div>
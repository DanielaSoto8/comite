
const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggleTop');
const contentWrapper = document.getElementById('content-wrapper');

// Función para alternar el sidebar
sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full'); // Mostrar/ocultar sidebar
    contentWrapper.classList.toggle('ml-64'); // Ajustar el contenido cuando se muestra el sidebar
});

<?php

if(!isset($_SESSION['id'])) {
    session_start();
}


if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    $tipo = (strpos($mensaje, 'Error') !== false) ? 'error' : 'success'; // Determina si el mensaje es de éxito o error
    echo "
   <div id='modal' class='fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50'>
    <div class='bg-white rounded-lg shadow-lg p-6 w-96'>
        <h3 class='text-lg font-bold text-gray-800'>$mensaje</h3>
        
        <!-- Botón para cerrar -->
        <div class='flex justify-center'>
            <button onclick='cerrarModal()' 
                class='px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition duration-300 ease-in-out'>
                Cerrar
            </button>
        </div>
    </div>
</div>";
}
?>
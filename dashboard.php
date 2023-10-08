<?php
    require './includes/funciones.php';

    incluirTemplate('header');
?>


    <main class="main main-dashboard">

        <div class="contenedor contenido-main">
            <div class="boton">
                <a href="formsalidas.php">Crear Salida</a>
            </div>
            <div class="boton">
                <a href="salidas.php">Ver Próximas Salidas</a>
            </div>
        </div>
        <div class="img-dashboard">
            <img  src="../escaladamz/img/4.jpg" alt="imagen-dashboard">
        </div>
    </main>





<?php
   incluirTemplate('footer'); 
?>
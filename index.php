<?php
    require './includes/funciones.php'; //require (si no lo encuentra nos marcará un error) para función. 
    incluirTemplate('header'); //llamamos la funcion para incluir header y pasamos como argumento header
?>

    <main class="main">
        <div class="contenedor">
            <h2>CREA TU PROPIA SALIDA O ÚNETE A UNA YA PROGRAMADA</h2>

            <section>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias ipsum perspiciatis commodi expedita, itaque totam perferendis et voluptatibus. Consequuntur ipsa ipsum voluptatem mollitia, vitae fuga saepe ipsam omnis eos error!</p>
                <img class="img-index" src="../escaladamz/img/rock.webp" width="750 px" height="500 px" alt="imagen-post">
            
            </section>

            <a class="boton-primario" href="dashboard.php">Quiero Escalar!</a>
        </div>

    </main>




<?php
   incluirTemplate('footer'); 
?>
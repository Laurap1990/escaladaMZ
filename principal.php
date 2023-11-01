<?php
    session_start();
    require './includes/funciones.php'; //require (si no lo encuentra nos marcará un error) para función. 
    incluirTemplate('header'); //llamamos la funcion para incluir header y pasamos como argumento
    
    
    require './includes/config/database.php';
    $db = conectarDB();

    //muestra resultado mostrado en la url
    $getResultado = $_GET['resultado'] ?? null;
    

?>

    <main class="main">
        <div class="contenedor">
            <h2>CREA TU PROPIA SALIDA O ÚNETE A UNA YA PROGRAMADA</h2>

            <?php if($getResultado == 1){?>
                <p class="alerta exito">Salida creada correctamente</p>
            <?php };?>

            <section class="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias ipsum perspiciatis commodi expedita, itaque totam perferendis et voluptatibus. Consequuntur ipsa ipsum voluptatem mollitia, vitae fuga saepe ipsam omnis eos error!</p>
                <img class="img-index" src="../escaladamz/img/rock2.jpg" width="750 px" height="500 px" alt="imagen-post">
            
            </section>

            <a class="boton-primario" href="dashboard.php">Quiero Escalar!</a>
        </div>

    </main>




<?php
   incluirTemplate('footer'); 
?>
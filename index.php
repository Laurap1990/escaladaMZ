<?php

    require './includes/funciones.php';
    incluirTemplate('headerlogin');

    
    //muestra resultado mostrado en la url
    $getResultado = $_GET['resultado'] ?? null;


    session_start();

    //variables
    $user= [];
    $id = [];

    //conectar base de datos
    require './includes/config/database.php';
    $db = conectarDB();

    if($getResultado == 1){
        //comprobamos el id del usuario si existe en $_SESSION
        $user = sesionUsuario($db);
    }    
?>


    <main class="centrar-texto main">

            <!-- SI EXISTE USUARIO LOGUEADO -->
            <?php if(!empty($user)): ?>

                <div class="contenedor">
                    <h2>Bienvenido a escaladaMZ <?php echo $user['nombre'] ?></h2>
                    <p>Te has logueado correctamente</p>
                    <br>
                    <div>
                        <a href="logout.php" class="boton-primario">Logout</a>
                        <a href="principal.php" class="boton-primario">Entra</a>
                    </div>
                    <div class="img-dashboard contenedor">
                        <img  src="img/rock.jpg" alt="imagen-dashboard">
                    </div>
                </div>
                
            <!-- SI NO EXISTE USUARIO LOGUEADO -->
            <?php else: ?>
                
                <h2>Crea una cuenta o inicia sesión</h2>
                <div class="centrar-texto contenedor ">
                    <a href="login.php">Inicia Sesión</a> ó
                    <a href="signup.php">Regístrate</a>
                    <div class="img-dashboard contenedor">
                        <img  src="img/rock.jpg" alt="imagen-dashboard">
                    </div>
                
                </div>

            <?php endif; ?>



                


    </main>
                

    <footer class="footer-dash">
        <div class="barra-footer">
            <p>Todos los derechos reservados <?php echo date('Y')?> ©</p>
        </div>
    </footer>

        
<script src="js.js"></script>
</body>
</html>
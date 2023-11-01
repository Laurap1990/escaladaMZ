<?php
    require './includes/funciones.php';

    incluirTemplate('header');

    //IMPORTA LA FUNCIÓN PARA CONECTAR A LA BASE DE DATOS
    require './includes/config/database.php';

    session_start();

    //conexión a la base de datos

    $db = conectarDB();

      //CONSULTAS

      $queryUser = "SELECT * FROM usuarios";
      $resultUser = mysqli_query($db, $queryUser);


      //VARIABLES GLOBALES

      $fecha = '';
      $hora = '';
      $lugar = '';
      $user= '';
      $id = '';
      $errores = [];
      $creado = date('Y/m/d');

      //comprobamos el id del usuario si existe en $_SESSION y asignamos valor
        $user = sesionUsuario($db);
        $id = $user['id'];
      //VEMOS CONTENIDO DEL POST

      if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $fechasalida = $_POST['fecha'] ?? null;
        $horasalida = $_POST['hora'] ?? null;
        $lugar = $_POST['lugar'] ?? null;
        

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        if($fechasalida == ''){
            $errores[] = "Debes introducir una fecha";
        }

        if($horasalida == ''){
            $errores[] = "Debes introducir una hora";
        }

        if($lugar == ''){
            $errores[] = "Debes introducir un lugar";
        }

        if($id == ''){
            $errores[] = "Introduce un Usuario";
        }

        if(empty($errores)){

            $querySalida = "INSERT INTO salidas (fechasalida, horasalida, lugar, usuarios_id, creado)
            VALUES ('$fechasalida', '$horasalida', '$lugar', '$id', '$creado')";

            $resultSalida = mysqli_query($db, $querySalida);


            //CREAMOS INSCRIPCIÓN AUTOMÁTICA DEL USUARIO EN SU PROPIA SALIDA
            //seleccionamos salidas
            $queryInscripcion = "SELECT id FROM salidas 
            WHERE usuarios_id = '$id' 
            ORDER BY creado DESC 
            LIMIT 1";

            $resultInscr = mysqli_query($db, $queryInscripcion);
            $salida = mysqli_fetch_assoc($resultInscr);
            $idsalida = $salida['id'];

            //insertamos incripcion
            $insertInscripcion = "INSERT INTO inscripciones (usuarioId, salidaId)
            VALUES ('$id', '$idsalida')";
            $resultado = mysqli_query($db, $insertInscripcion);

            if($resultSalida){
                header('Location: /escaladamz/principal.php?resultado=1');
            }
        }

      }


    

    //
?>

<main class="main main-contacto">
        <h2 class="titulo">Crea tu propia Salida</h2>

        <?php foreach($errores as $error): ?>

            <div class="alerta error">
             <p><?php echo $error ?></p>
            </div>

        <?php endforeach; ?>


        <div class="contenedor contenedor-formulario">

            <form method="POST" class="formulario" action="/escaladamz/formsalidas.php">
                <fieldset>
                    <legend>Crea tu propia salida</legend>
                
                    <label for="fecha" >Dinos qué día escalamos</label>
                    <input type="date" min = "<?php echo date('Y-m-d') ?>" value="fecha" placeholder="fecha" id="fecha" name="fecha" value="<?php echo $fecha ?>">

                    <label for="hora">Establece una hora</label>
                    <input type="time" value="hora" placeholder="hora" id="hora" name="hora" value="<?php echo $hora ?>">

                    <label for="lugar">Dinos donde escalamos, se lo más explícitx que puedas.
                    </label>
                    <textarea name="lugar" id="" cols="15" rows="7" placeholder="Punto de encuentro" value="<?php echo $lugar ?>"></textarea>

                </fieldset>


                <input type="submit" value="enviar" class="boton-primario">
            
            </form>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>
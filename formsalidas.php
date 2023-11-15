<?php
    require './includes/funciones.php';
       require './clases/user.php';
       require './clases/classSalida.php';

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
      $user= '';
      $id = '';
      $errores = [];
      $creado = date('Y/m/d');

      //comprobamos el id del usuario si existe en $_SESSION y asignamos valor
        $user = sesionUsuario($db);
        $id = $user['id'];
      //VEMOS CONTENIDO DEL POST

      if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $salida = new salida($_POST);
        $salida -> setCreado($creado);
        $salida -> setUsuario($id);
    
        if($_POST['fechasalida'] == ''){
            $errores[] = "Debes introducir una fecha";
        }

        if($_POST['horasalida'] == ''){
            $errores[] = "Debes introducir una hora";
        }

        if($_POST['lugar'] == ''){
            $errores[] = "Debes introducir un lugar";
        }

        if(empty($errores)){

            $query = $salida -> crearSalida();
            $resultado = mysqli_query($db, $query);
            


            //CREAMOS INSCRIPCIÓN AUTOMÁTICA DEL USUARIO EN SU PROPIA SALIDA
            //seleccionamos salidas
            $querySalida = $salida -> selectSalida();
            $resultSalida = mysqli_query($db, $querySalida);
            $salidaSeleccionada = mysqli_fetch_assoc($resultSalida);

            $idSalida = $salidaSeleccionada['id'];

            //insertamos incripcion
            $insertInscripcion = "INSERT INTO inscripciones (usuarioId, salidaId)
            VALUES ('$id', '$idSalida')";
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
                
                    <label for="fechasalida" >Dinos qué día escalamos</label>
                    <input type="date" min = "<?php echo date('Y-m-d') ?>" value="fecha" placeholder="fecha" id="fechasalida" name="fechasalida" value="<?php echo $fecha ?>">

                    <label for="horasalida">Establece una hora</label>
                    <input type="time" value="hora" placeholder="hora" id="horasalida" name="horasalida" value="<?php echo $hora ?>">

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
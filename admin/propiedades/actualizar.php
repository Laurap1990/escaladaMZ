<?php

    //VALIDAR LA URL ID VALIDO
    //asignamos el valor a una variable
    $id = $_GET['id'] ?? NULL;
    //lo filtramos para que solo pueda ser un INT
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //Si esta variable no es válida (retorna false) entonces redirecciona a index
    if(!$id){
        header('Location: /escaladamz/admin/index.php');
    };


    //conexión a Base de datos
    require '../../includes/config/database.php';

    $db=conectarDB();

        
    //CONSULTA PARA OBTENER LOS DATOS DE LA SALIDA
    $consultaDatos = "SELECT * FROM salidas WHERE id = {$id}";
    //coge bien el contenido de ID
    //echo $consultaDatos;
    $resultado = mysqli_query($db, $consultaDatos);
    $salida = mysqli_fetch_assoc($resultado);
    
    // echo "<pre>";
    // var_dump($salida);
    // echo "</pre>";

    //CONSULTANDO BBDD PARA OBTENER USUARIOS

    $consultaUsuarios = "SELECT * FROM usuarios";
    $resultado = mysqli_query($db, $consultaUsuarios);    

    //VARIABLES GLOBALES
    $fechasalida = $salida['fechasalida'];
    $horasalida = $salida['horasalida'];
    $lugar = $salida['lugar'];
    $usuarios_id = $salida['usuarios_id'];


    //ARREGLO QUE ALMACENA ERRORES

    $errores = [];



    //EJECUTA CÓDIGO TRAS EL USUARIO ENVIAR EL FORMULARIO

        //si REQUEST_METHOD que por default está en get, es POST
        //entonces imprime el contenido de post. Con esto podemos ver los datos enviados en el formulario.
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //echo "<pre>";
            //var_dump($_POST);
            //echo "</pre>";
            

            //ALMACENAMOS EN VARIABLES EL CONTENIDO DE CADA POST
            $fechasalida = $_POST['fecha'] ?? null;
            $horasalida = $_POST['hora'] ?? null;
            $lugar = $_POST['lugar'] ?? null;
            $usuarios_id = $_POST['usuario'] ?? null;
            $creado = date('Y/m/d'); 


            if($fechasalida == ''){
                $errores[] = "Debes introducir una fecha";
            }

            if($horasalida == ''){
                $errores[] = "Debes introducir una hora";
            }

            if($lugar == ''){
                $errores[] = "Debes introducir un lugar";
            }

            if($usuarios_id == ''){
                $errores[] = "Introduce un Usuario";
            }

            // echo "<pre>";
            // var_dump($errores);
            // echo "</pre>";


    //CÓDIGO QUE SE EJECUTA SI NO HAY ERRORES
        if(empty($errores)){
            //insertar datos en la BBDD creando una variable query

            $query = "UPDATE salidas 
            SET 
            fechasalida = '{$fechasalida}',
            horasalida = '{$horasalida}',
            lugar = '{$lugar}'
            WHERE id = '{$id}'
            ";

            // echo $query;

            // exit;

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //reedireccionamos al usuario SI EL RESULTADO ES CORRECTO
                header('Location: /escaladamz/admin/index.php?resultado=2');
            }
        }

    }



    //INCLUIMOS funciones.php PARA PODER VER EL HEADER Y EL FOOTER. 
    require '../../includes/funciones.php';
    //LLamamos a la función y pasamos el header como argumento
    incluirTemplate('header');
?>

<!-- HTML -->

    <section>
        <div class="contenedor">
            <div>
                <h1 class="centrar-texto">Actualizar Propiedad</h1>

                <a href="../index.php" class="boton-block">Volver</a>

                <?php foreach($errores as $error): ?>
                    <div class="alerta error">
                        <?php echo $error ?>
                    </div>

                <?php endforeach; ?>
            </div>

            <!-- Quitamos el action al form, para que el submit envie los datos a este mismo archivo con ese ID -->
            <form class="formulario" method="POST">
                <fieldset>
                    <legend>Infomación de la Salida</legend>

                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" placeholder="fecha salida"  value="<?php echo $fechasalida ?>">

                    <label for="hora">Hora</label>
                    <input type="time" name ="hora" id="hora" placeholder="hora salida" value="<?php echo $horasalida?>">

                    <label for="lugar">Lugar</label>
                    <textarea name="lugar" id="lugar" cols="15" rows="7" placeholder="punto de encuentro" value="<?php echo $lugar ?>"><?php echo $lugar ?></textarea>

                </fieldset>

                <fieldset>
                    <legend>Usuario</legend>

                    <select name="usuario">
                        <option value="">--Seleccione--</option>
                        <?php //recorremos BBDD con el resultado de la consulta
                        while ($usuario = mysqli_fetch_assoc($resultado)){ ?>
                            <option
                            <?php //si coincide el id de la base de datos con el post ponemos un selected en el option
                            if($usuarios_id === $usuario['id']){
                                echo 'selected';
                            }else{
                                echo '';
                            } ?>
                             value="<?php echo $usuario['id']; ?>">
                            <?php //imprimimos en html el nombre y apellido del usuario
                            echo $usuario['nombre'] . " " . $usuario['apellido1'];?></option>
                        <?php };?>

                    </select>
                </fieldset>

                <input type="submit" value="Actualizar" class="boton-primario">
            </form>
            


        </div>
    </section>

<?php
    incluirTemplate('footer');
?>
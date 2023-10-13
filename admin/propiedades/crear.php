<?php

    //INCLUIMOS funciones.php PARA PODER VER EL HEADER Y EL FOOTER. 
    require '../../includes/funciones.php';
    //LLamamos a la función y pasamos el header como argumento
    incluirTemplate('header');
    
    
    //conexión a Base de datos
    require '../../includes/config/database.php';

    $db=conectarDB();

    
    //CONSULTANDO BBDD PARA OBTENER USUARIOS

    $consulta = "SELECT * FROM usuarios";
    $resultado = mysqli_query($db, $consulta);



    //EJECUTA CÓDIGO TRAS EL USUARIO ENVIAR EL FORMULARIO

    //VARIABLES GLOBALES
    $fechasalida = '';
    $horasalida = '';
    $lugar = '';
    $usuarios_id = '';

    //ARREGLO QUE ALMACENA ERRORES

    $errores = [];

    //si REQUEST_METHOD que por default está en get, es POST
    //entonces imprime el contenido de post. Con esto podemos ver los datos enviados en el formulario.
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //     echo "<pre>";
        //     var_dump($_POST);
        //     echo "</pre>";
        

        //ALMACENAMOS EN VARIABLES EL CONTENIDO DE CADA POST
        $fechasalida = $_POST['fecha'] ?? null;
        $horasalida = $_POST['hora'] ?? null;
        $lugar = $_POST['lugar'] ?? null;
        $usuarios_id = $_POST['usuario'] ?? null;
        $creado = date('Y/m/d');

        //validamos cada campo, no puede estar vacío
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

            $query = " INSERT INTO salidas (fechasalida, horasalida, lugar, usuarios_id, creado)
            VALUES ('$fechasalida', '$horasalida', '$lugar', '$usuarios_id', '$creado')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //reedireccionamos al usuario SI EL RESULTADO ES CORRECTO
                header('Location: /escaladamz/admin/index.php?resultado=1');
            }
        }
    }

?>

    <section>
        <div class="contenedor">
            <div>
                <h1>Crear</h1>

                <a href="../index.php" class="boton-block">Volver</a>
                <?php foreach($errores as $error): ?>

                    <div class="alerta error">
                        <?php echo $error ?>
                    </div>

                <?php endforeach; ?>
            </div>


            <form class="formulario" method="POST" action="/escaladamz/admin/propiedades/crear.php">
                <fieldset>
                    <legend>Infomación de la Salida</legend>

                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" placeholder="fecha salida"  value="<?php echo $fechasalida ?>">

                    <label for="hora">Hora</label>
                    <input type="time" name ="hora" id="hora" placeholder="hora salida" value="<?php echo $lugar ?>">

                    <label for="lugar">Lugar</label>
                    <textarea name="lugar" id="lugar" cols="15" rows="7" placeholder="punto de encuentro" value="<?php echo $lugar ?>"></textarea>

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

                <input type="submit" value="Crear Salida" class="boton-primario">
            </form>
            


        </div>
    </section>

<?php
    incluirTemplate('footer');
?>
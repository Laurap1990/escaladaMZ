<?php
    session_start();

    //incluye template header
    require '../includes/funciones.php';
    //llamamos a la función incluir template y pasamos header como argumento
    incluirTemplate('header');


    //IMPORTAR BASE DE DATOS
    //importar la conexion
    require '../includes/config/database.php';

    $db=conectarDB();

    //escribo query

    $query = "SELECT * FROM salidas";

    //consultar la BD
    $resultadoQuery = mysqli_query($db, $query);


    //muestra resultado almacenado en get
    $resultado = $_GET['resultado'] ?? null;

    //vamos a revisar el request method. puesto en el form para el input de eliminar
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $id = $_POST['id'];
        //filtramos id para que solo pueda ser un int
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            //eliminar la propiedad
            //creamos el query si hay un ID
            $query1 = "DELETE FROM inscripciones WHERE salidaId = {$id}";
            $query2 = "DELETE FROM salidas WHERE id = {$id}";
            //hacemos petición
            $resultado1 = mysqli_query($db, $query1);
            $resultado2 = mysqli_query($db, $query2);

            if($resultado2){
                header('Location: /escaladamz/admin/index.php?resultado=3');
            }
            
        }
        //var_dump($_POST);
    }


?>

    <section>
        <div class="contenedor">
            <h1 class="centrar-texto">Menú admin de EscaladaMZ</h1>
            <?php
            if($resultado == 1) : ?>

                <p class="alerta exito">Salida creada correctamente</p>
            <?php elseif($resultado == 2) : ?>
                <p class="alerta exito">Salida actualizada correctamente</p>
            <?php elseif($resultado == 3) : ?>
                <p class="alerta exito">Salida eliminada correctamente</p>
            <?php endif; ?>

            <a href="../admin/propiedades/crear.php" class="boton-primario">Crear</a>

        </div>
        <div class="tabla">       
            <table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Lugar</th>
                        <th>Usuario</th>
                        <th>Creada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> <!-- MOSTRAMOS RESULTADOS DE SALIDAS DE BBDD -->
                <!-- RECORREMOS BD -->
                <?php while($salida = mysqli_fetch_assoc($resultadoQuery)): ?>
                    <tr>
                        <td><?php echo $salida['id']; ?></td>
                        <td><?php echo $salida['fechasalida'];?></td>
                        <td><?php echo $salida['horasalida'];?></td>
                        <td><?php echo $salida['lugar'];?></td>
                        <td><?php echo $salida['usuarios_id'];?></td>
                        <td><?php echo $salida['creado'];?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $salida['id'];?>">
                                <input type="submit" class="boton-block-eliminar" value="eliminar">
                            </form>
                            <a href="/escaladamz/admin/propiedades/actualizar.php?id=<?php echo $salida['id'];?>" class=" boton-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </section>

<?php
    //cerrar base de datos
    mysqli_close($db);
    incluirTemplate('footer');
?>
<?php
    //importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();

    //consultas
    $querySalida = "SELECT * FROM usuarios INNER JOIN salidas ON salidas.usuarios_id = usuarios.id";

    //consultamos la BD
    $resultadoSalidas = mysqli_query($db, $querySalida);

    



    //vamos a revisar el request method. puesto en el form para el input de eliminar
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $id = $_POST['id'];
        $idSalida = $_POST['idSalida'];
        //filtramos id para que solo pueda ser un int
        $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                //agregar la propiedad a tabla inscripciones
                //creamos el query si hay un ID
                $query = "INSERT INTO inscripciones (usuarioId, salidaId)
                            VALUES ('{$id}', '{$idSalida}')";
                //hacemos petición
                $resultado = mysqli_query($db, $query);

                if($resultado){
                    header('Location: /escaladamz/salidas.php');
                }
            
            }  

        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
    }



?>

    <section>
        <div>
            <h2 class="centrar-texto">PRÓXIMAS SALIDAS DISPONIBLES</h2>

            <div class="tabla">

                <table class="propiedades">
                    <thead>
                        <tr>
                            <th>SALIDA Nº</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>LUGAR</th>
                            <th>USUARIO</th>
                            <th>UNIRSE</th>
                        </tr>
                    </thead>
                    <TBody>
                    <?php while($salida = mysqli_fetch_assoc($resultadoSalidas)){?>

                        <tr>
                            <td><?php echo $salida['id'];?></td>
                            <td><?php echo $salida['fechasalida'];?></td>
                            <td><?php echo $salida['horasalida'];?></td>
                            <td><?php echo $salida['lugar'];?></td>
                            <td><?php echo $salida['nombre'];?></td>
                            <td>
                                <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $salida['usuarios_id'];?>">
                                <input type="hidden" name="idSalida" value="<?php echo $salida['id'];?>">
                                <input type="submit" class="boton-block" value="Unirse">
                                </form>

                            </td>
                        </tr>
                    <?php };?>
                    </TBody>
                    
                </table>


                
            </div>
        </div>
    </section>

<?php
    mysqli_close($db);
?>
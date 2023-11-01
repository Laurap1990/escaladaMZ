<?php
    //importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();

    session_start();

    $getResultado = $_GET['resultado'] ?? NULL;

    //LLamamos a la funcion usuario
    $user = sesionUsuario($db);

    //consulta DE DOS TABLAS.
    $querySalida = "SELECT * FROM usuarios INNER JOIN salidas ON salidas.usuarios_id = usuarios.id";

    //consultamos la BD
    $resultadoSalidas = mysqli_query($db, $querySalida);

?>

    <section>
        <div>
            <h2 class="centrar-texto">PRÓXIMAS SALIDAS DISPONIBLES</h2>
            <div class="tabla">
                        
        <?php if($getResultado == 1){?>
            <p class="alerta exito">Te has unido correctamente</p>
        <?php };?>
                <table class="propiedades">
                    <thead>
                        <tr>
                            <th>SALIDA Nº</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>LUGAR</th>
                            <th>CREADO POR</th>
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
                                <form method="GET">
                                <a href="salida.php?salida=<?php echo $salida['id']?>" type="botom" class="boton-block" value="unirse">Unirse</a>
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
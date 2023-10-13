<?php
    //importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();

    //consultas
    $querySalida = "SELECT * FROM salidas";

    //consultamos la BD
    $resultadoSalidas = mysqli_query($db, $querySalida);



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
                            <td>
                                <form method="POST">
                                    <input type="submit" class="boton-block" value="UNIRSE">
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
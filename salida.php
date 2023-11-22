<?php
    require './includes/funciones.php'; //require (si no lo encuentra nos marcará un error) para función. 
    incluirTemplate('header'); //llamamos la funcion para incluir header y pasamos como argumento
    session_start();

    require './clases/classSalida.php';
    require './clases/classInscripcion.php';

    //IMPORTA LA FUNCIÓN PARA CONECTAR A LA BASE DE DATOS
    require './includes/config/database.php';

    //conexión a la base de datos
    $db = conectarDB();

   //LLamamos a la funcion usuario
   $user = sesionUsuario($db);

   //creamos un objeto inscripcion
   $inscripcion = new inscripcion();

   //VARIABLES
    $numSalida = $_GET['salida'];
    $userInscrito=[];
    $errores='';
    //query para seleccionar solo la salida seleccionada en salidas.php
   $salida = new salida();
   $querySalida = $salida -> selectSalidaId($numSalida);
   $resultadoSalidas = mysqli_query($db, $querySalida);

    //query para no poder inscribirse una vez inscrito
   $queryInscripcion = "SELECT * FROM inscripciones WHERE usuarioId = {$user['id']} AND salidaId = $numSalida";
   $resultadoInscripcion = mysqli_query($db, $queryInscripcion);
   $userInscrito = mysqli_fetch_assoc($resultadoInscripcion);

   //query para contar usuarios registrados
   $queryCount = $inscripcion -> contarUsuarios($numSalida);
   $resultadoCount = mysqli_query($db, $queryCount);
   $count = mysqli_fetch_assoc($resultadoCount);



   if(empty($userInscrito)){
        //vamos a revisar el request method. puesto en el form para el input
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $user['id'];
                if($id){
                    //agregar la propiedad a tabla inscripciones
                    //creamos el query si hay un ID
                    
                    $query = $inscripcion -> crearInscripcion($id, $numSalida);
                    //hacemos petición
                    $resultado = mysqli_query($db, $query);

                    if($resultado){
                        header('Location: /escaladamz/salidas.php?resultado=1');
                    }     
                        
                }
                
        }  
    }else{
        $errores = "Usuario ya inscrito";
    }



?>

<main class="centrar-texto main">
    <?php if(!empty($errores)){?>
        <p class="alerta error"><?php echo $errores; ?></p>
    <?php } ?>

    <?php while($salida = mysqli_fetch_assoc($resultadoSalidas)){?>
        <h1>SALIDA Nº <?php echo $salida['id']?>  </h1>

        <div class="contenedor salida">
            <h3 class="enunciado">Únete para escalar juntos!</h3>
            <ul class="lista centrar texto">
                <li>
                    <h3>Nº de Salida</h3>
                    <p><?php echo $salida['id'];?></p>
                </li>
                <li>
                    <h3 class="linea">Fecha</h3>
                    <p><?php echo $salida['fechasalida'];?></p>
                </li>
                <li>
                    <h3 class="linea">Hora</h3>
                    <p><?php echo $salida['horasalida'];?></p>
                </li>
                <li>
                    <h3 class="linea">Lugar</h3>
                   <p><?php echo $salida['lugar'];?></p>
               </li>
               <li>
                    <h3 class="linea">Nº Escaladores Registrados</h3>
                   <p><?php echo $count['usuarios'];?></p>
               </li>
               <form method="POST">
               <input type="submit" class="boton-primario centrar-texto" value="Unirse">
               </form>
            </ul>
    <?php };?>
        </div>
    </main>


<?php
   incluirTemplate('footer'); 
?>
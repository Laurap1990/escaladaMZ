<?php

    require 'app.php'; //llamamos a app.php


    function incluirTemplate(string $nombre){ //CREAMOS FUNCION PARA PODER INCLUIR LOS TEMPLATES Y ESTABLECEMOS PARÁMETRO
        include TEMPLATES_URL . "/$nombre.php"; // colocamos la variable
    }

    function sesionUsuario(mysqli $con):array{
        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM usuarios WHERE id = {$id}";
            $resultado = mysqli_query($con, $query);
            $datos = mysqli_fetch_assoc($resultado);
    
            if(count($datos) > 0){
                return $datos;
            }
        }
    }
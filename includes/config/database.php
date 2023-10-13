<?php

    //creamos una función para conectar a la base de datos, que retorna un objeto de tipo mysqli

    function conectarDB() : mysqli{
        $db = mysqli_connect('localhost', 'root', 'root', 'escaladamz');

        if(!$db){
            echo "Error, no se pudo conectar";
            exit; //si no conecta, detenemos la ejecución aquí.
        }

        return $db;
    }
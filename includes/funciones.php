<?php

    require 'app.php'; //llamamos a app.php


    function incluirTemplate(string $nombre){ //CREAMOS FUNCION PARA PODER INCLUIR LOS TEMPLATES Y ESTABLECEMOS PARÁMETRO
        include TEMPLATES_URL . "/$nombre.php"; // colocamos la variable
    }
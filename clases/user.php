<?php

use PhpParser\Node\Arg;
    class user{


        public $id;
        public $nombre;
        public $apellido;
        public $nick;
        public $email;
        public $pass;

        public function __construct($args = []){
            $this ->id = $args['id'] ?? '';
            $this ->nombre = $args['nombre'] ?? '';
            $this ->apellido = $args['apellido'] ?? '';
            $this ->nick = $args['nick'] ?? '';
            $this ->email = $args['email'] ?? '';
            $this ->pass = $args['pass'] ?? '';
        }

        public function createUser(){
            $this->pass = $this->passHash($this->pass);
            $query = "INSERT INTO usuarios (nick, email, nombre, apellido1, password)
                        VALUES ('$this->nick','$this->email', '$this->nombre', '$this->apellido', '$this->pass')";
            return $query;
        }

        public function passHash($pass){
            $this->pass = password_hash($pass, PASSWORD_BCRYPT);
            return $this->pass;
        }

        public function loginUser($email){
            $query = "SELECT id, email, password FROM usuarios WHERE email = '{$email}'";
            return $query;
        }

        

    }
?>
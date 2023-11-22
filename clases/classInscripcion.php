
<?php

    class inscripcion {

        public $id;
        public $usuarioId;
        public $salidaId;


        public function __construct($args = []){
            $this ->id = $args['id'] ?? '';
            $this ->usuarioId = $args['usuarioId'] ?? '';
            $this ->salidaId = $args['salidaId'] ?? '';
        }

        public function crearInscripcion($id, $numSalida){
            $query = "INSERT INTO inscripciones (usuarioId, salidaId)
            VALUES ('{$id}', '{$numSalida}')";
            return $query;
        }

        public function contarUsuarios($numSalida){
            $query = "SELECT COUNT(*) AS usuarios FROM inscripciones WHERE salidaId = {$numSalida}";
            return $query;
        }


    }

?>
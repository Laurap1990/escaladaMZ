<?php
use PhpParser\Node\Arg;
class salida {

    public $id;
    public $fechasalida;
    public $horasalida;
    public $lugar;
    public $usuarios_id;
    public $creado;

    public function __construct($args = []){

        $this ->id = $args['id'] ?? '';
        $this ->fechasalida = $args['fechasalida'] ?? '';
        $this ->horasalida = $args['horasalida'] ?? '';
        $this ->lugar = $args['lugar'] ?? '';
        $this ->usuarios_id = $args['usuarios_id'] ?? '';
        $this ->creado = $args['creado'] ?? '';

    }

    		/**
		 * setter/getter
		 */
		public function setId( $id )
        {	$this->id = $id; 
        }
		public function getId(){

             return $this->id; 
            }
		public function setFecha( $fechasalida ){
            	$this->fechasalida = $fechasalida; 
            }
		public function getFecha(){
             return $this->fechasalida; 
            }
		public function setHora( $horasalida ){
            	$this->horasalida = $horasalida; 
            }
		public function getHora(){
             return $this->horasalida; 
            }
		public function setUsuario( $usuarios_id ){
            	$this->usuarios_id = $usuarios_id; 
            }
		public function getUsuario(){
             return $this->usuarios_id; 
            }
            public function setCreado( $creado ){
            	$this->creado = $creado; 
            }
		public function getCreado(){
             return $this->creado; 
            }

        public function crearSalida(){
            $query = "INSERT INTO salidas (fechasalida, horasalida, lugar, usuarios_id, creado)
            VALUES ('$this->fechasalida', '$this->horasalida', '$this->lugar', '$this->usuarios_id', '$this->creado')";
            return $query;
        }

        public function selectSalida(){
            $query = "SELECT id FROM salidas 
            WHERE usuarios_id = '$this->usuarios_id' 
            ORDER BY creado DESC 
            LIMIT 1";

            return $query;
        }

}

?>
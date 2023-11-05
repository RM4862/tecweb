<?php
class Persona{
    private $nombre;

    public function inicializar ($name){ //metodo
        $this->nombre=$name;
    }

    public function mostrar (){
        echo '<p>'.$this->nombre.'</p>';
    }
    
}
?>
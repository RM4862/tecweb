<?php
    Class Menu
    {
        private $enlaces = array();
        private $titulos = array();

        public function cargar_opcion($link,$title){ //crece el array dinamicamente
            $this->enlaces[]=$link;
            $this->titulos[]=$title;
        }

        public function mostrar(){
            for($i=0;$i<count($this->enlaces);$i++){
                echo '<a href=" ' .$this->enlaces[$i] .
                '">' .$this->titulos[$i] .' </a>'; //un atributo tiene comillas dobles

                //Se mueve '-' mientras $i sea menor que el tamaño del arreglo -1
                if ($i<count($this->enlaces)-1){
                    echo '-';
                }
            }
        }
    }
    
?>
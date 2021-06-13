<?php

class Concentrado {

    private $idconcentrado;
    private $nombre;


    public function __construct($nombre){
        $this->nombre = $nombre;
    }

    public function getidconcentrado(){
        return $this->idconcentrado;
    }
    
    public function getnombre(){
        return $this->nombre;
    }

    public function setidconcentrado($id){
     $this->idconcentrado=$id;
    }


}



?>
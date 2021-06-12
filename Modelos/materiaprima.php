<?php

class MateriaPrima{

    private $idmp;
    private $nombre;
    private $cantidad;

    public function __construct($nombre, $cantidad){
        
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
    }

    public function setidmp($idmp){
        $this->idmp = $idmp;
    }

    public function getidmp(){
        return $this->idmp;
    }

    public function getnombre(){
        return $this->nombre;
    }

    public function getcantidad(){
        return $this->cantidad;
    }
}
?>
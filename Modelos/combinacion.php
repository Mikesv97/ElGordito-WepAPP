<?php

class Pedidos {

    private $idcomb;
    private $idusuario;

    public function __construct($idcomb, $idusuario){
        $this->idcomb = $idcomb;
        $this->idusuario = $idusuario;

    }

    public function getidcomb(){
        return $this->idcomb;
    }

    public function getidusuario(){
        return $this->idusuario;
    }

    public function setidcomb($idcomb){
        $this->idcomb = $idcomb;
    }
}



?>
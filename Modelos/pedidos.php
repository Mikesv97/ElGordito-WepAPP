<?php

class Pedidos {

    private $idpedido;
    private $idusuario;

    public function __construct($idpedido, $idusuario){
        $this->idpedido = $idpedido;
        $this->idusuario = $idusuario;

    }

    public function getidpedido(){
        return $this->idpedido;
    }

    public function getidusuario(){
        return $this->idusuario;
    }

    public function setidpedido($idpedido){
        $this->idpedido = $idpedido;
    }
}



?>
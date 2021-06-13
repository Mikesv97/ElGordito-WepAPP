<?php

class Usuario {

    private $idusuario;
    private $nombre;
    private $contraseña;
    private $correo;
    private $idrol;

    public function __construct($nombreusuario, $correo, $idrol){
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->idrol = $idrol;

    }

    public function getidusuario(){
        return $this->idusuario;
    }
    
    public function getnombre(){
        return $this->nombre;
    }

    public function getcorreo(){
        return $this->correo;
    }

    public function getcontraseña(){
        return $this->contraseña;
    }

    public function getidrol(){
        return $this->idrol;
    }

    public function setidusuario($idusuario){
        $this->idusuario = $idusuario;
    }

    public function setcontraseña($idcontraseña){
        $this->idcontraseña = $idcontraseña;
    }
}



?>
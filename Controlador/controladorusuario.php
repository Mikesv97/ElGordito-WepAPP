<?php
include_once '../Modelos/daousuario.php';
include_once '../Modelos/usuario.php';

$daouser =new DaoUsuario();

$respuesta ="";

if($_POST){
    if(isset($_POST["key"])){
        $key=$_POST["key"];
        
        switch($key){

            case "getUsuarios":
               
                $daouser-> getUsuarios();
              
            break;

        }
    }
}
?>
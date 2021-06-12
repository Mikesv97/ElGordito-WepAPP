<?php
include_once '../Modelos/daocombinacion.php';
include_once '../Modelos/combinacion.php';

$daosug =new DaoCombinacion();

$respuesta ="";

if($_POST){
    if(isset($_POST["key"])){
        $key=$_POST["key"];
        
        switch($key){

            case "getTablaSug":
               
                $daosug->getTablaSugerencias()
              
            break;

            case "EliminarPed":

               
             break;

        }
    }
}

?>
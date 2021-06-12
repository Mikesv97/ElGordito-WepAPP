<?php
include_once '../Modelos/daopedidos.php';
include_once '../Modelos/pedidos.php';

$daopd =new DaoPedidos();

$respuesta ="";

if($_POST){
    if(isset($_POST["key"])){
        $key=$_POST["key"];
        
        switch($key){

            case "getTablaPed":
               $daopd->getTablaPedidos();
              
            break;

        }
    }
}

?>
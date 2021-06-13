<?php
session_start();
include '../Modelos/daoconcentrados.php';
include '../Modelos/detallepedido.php';

$daocon= new DaoConcentrados();
$daoped= new DaoDetallePedido();
if($_POST){
    if(isset($_POST["key"])){
        $key=$_POST["key"];
        
        switch($key){

            case "getProductos":
                $daocon->getTablaConcentrados();
              
            break;

            case "NewPedido":
               parse_str($_POST["data"],$data);
                $idped= $daoped->insertarPedido($_SESSION["id"]);
                $daoped->insertardetapedido($idped,$data["concentrado"],$data["cantmp"]);

              
            break;

            case "getConcentrados":

                $daoped->cargarconcentrados();
              
            break;
        }
 
    }
}

?>
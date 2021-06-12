<?php
include_once '../Modelos/daomateriaprima.php';
include_once '../Modelos/materiaprima.php';

$daomp =new DaoMateriaPrima();

$respuesta ="";

if($_POST){
    if(isset($_POST["key"])){
        $key=$_POST["key"];
        
        switch($key){

            case "getTablaMP":
                $daomp->getTablaMP();
              
            break;

            case "NuevaMp":
                parse_str($_POST["data"], $data);
                $mp= new MateriaPrima($data["nombremp"], $data["cantmp"]);
                $daomp->insertar($mp->getnombre(),$mp->getcantidad());

             break;

             case "EliminarMp":
                $id= $_POST["data"];
                $daomp->eliminar($id);
             break;

             case "ModMp":
                parse_str( $_POST["data"],$data);
                $mp = new MateriaPrima($data["nombremp"],$data["cantmp"]);
                $mp->setidmp($data["idmp"]);
                $daomp->modificar($mp);
             break;

             case "verificarMp":
                $daomp->verificarMpE();
             break;

             case "getTablaMPE":
                $daomp->getTablaMPE();
             break;
        }
    }
}

?>
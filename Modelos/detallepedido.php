<?php
include  'pedidos.php';
class DaoDetallePedido{
    private $con ;

    public function __construct(){

    }

    public function conectar(){
        try{
    
            $this->con = new mysqli(SERVER, USER, PASS, BD);
    
        }catch(Exception $error){
            echo $error->getTraceAsString();
        }
    
    }

    public function desconectar(){
        $this->con->close();
    
    
    }

   public function insertarPedido($idusuario){
    $iduser = $idusuario;
    $sql = "insert into pedidos values (null,".$iduser.")";
    $this->conectar();

    if($this->con->query($sql)){
        $sql = "select max(id_pedido) as id from pedidos";
        $resultado=$this->con->query($sql);
         $num = mysqli_fetch_assoc($resultado);
        return $num["id"];
    }else{
        echo "Falló Al Ingresarlo";
    }
 
    $this->desconectar();

   }

   public function insertardetapedido($idpedido,$idconcentrado,$cantidad){
       $sql="insert into detalle_pedido values (null,".$idpedido.",".$idconcentrado.",".$cantidad.",'".date('d-m-Y')."')";
       $this->conectar();
       if($this->con->query($sql)){
            echo "Registro Insertado Correctamente";
        }else{
            echo "Falló Al Ingresarlo, Intenta De Nuevo.";
        }
    }

    public function cargarconcentrados(){
        $con = new mysqli("localhost","root","", "elgordito");
        $sql ="select * from concentrados;";
        $res = $con->query($sql);
        $opciones ="";
        while($fila = mysqli_fetch_assoc($res)){
            $opciones .= "<option value='" . $fila['id_concentrado'] . "'>". $fila['nombre'] . "</option>";
        }
     echo $opciones;
    }
}
?>
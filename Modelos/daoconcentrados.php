<?php
include 'credenciales.php';
include  'concentrados.php';

class DaoConcentrados{
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

    public function getTablaConcentrados(){
        $sql="select * from concentrados";
        $this->conectar();
        $resultado = $this->con->query($sql);
    
        
        $this->desconectar();
        //armar la tabla html
        $tabla= '<table class="table col-12"><thead class="table-dark"><tr><th scope="col"># Concentrado</th><th scope="col">Nombre</th></tr></thead><tbody>';
    
        while($fila = mysqli_fetch_assoc($resultado)){
    
        $tabla.= '<tr>';
        $tabla.= '<th scope="row">'.$fila["id_concentrado"].'</th>';
        $tabla.='<td>'.$fila["nombre"].'</td>';
        
        }                                                               
    
        $tabla.='</tr></tbody></table>';
    
        $resultado->close();
        echo $tabla;
    }

    public function eliminar($id){
        $id = $id;
        $sql ="delete from pedidos where id_pedido =".$id;
        $this->conectar();
        if($this->con->query($sql)){
            echo "Registro Eliminado Con Exito";
        }else{
            echo "No Se Pudo Eliminar, Intente De Nuevo";
        }
        $this->desconectar();
    }   
}
?>
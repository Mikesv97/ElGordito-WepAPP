<?php
include 'credenciales.php';
include  'pedidos.php';
class DaoPedidos{
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

    public function getTablaPedidos(){
        $sql="select detalle_pedido.id_detalle, pedidos.id_pedido, usuario.nombre, concentrados.nombre as concentrado, detalle_pedido.cantidad, detalle_pedido.fecha 
        from detalle_pedido  
        inner join pedidos  on detalle_pedido.id_pedido = pedidos.id_pedido 
        inner join concentrados on  detalle_pedido.id_concentrado = concentrados.id_concentrado 
        left join usuario on usuario.id_usuario = pedidos.id_usuario";
        $this->conectar();
        $resultado = $this->con->query($sql);
    
        
        $this->desconectar();
        //armar la tabla html
        $tabla= '<table class="table col-12"><thead class="table-dark"><tr><th scope="col"># Detalle</th><th scope="col"># Pedido</th>
        <th scope="col">Nombre Cliente</th><th scope="col">Concentrado</th><th scope="col">Cantidad (QQ)</th><th scope="col">Fecha</th><th scope="col">Acción</th></tr></thead><tbody>';
    
        while($fila = mysqli_fetch_assoc($resultado)){
    
        $tabla.= '<tr>';
        $tabla.= '<th scope="row">'.$fila["id_detalle"].'</th>';
        $tabla.='<td>'.$fila["id_pedido"].'</td>';
        $tabla.='<td>'.$fila["nombre"].'</td>';
        $tabla.='<td>'.$fila["concentrado"].'</td>';
        $tabla.='<td>'.$fila["cantidad"].'</td>';
        $tabla.='<td>'.$fila["fecha"].'</td>';
        $tabla.= "<td><button type='button' class='btn btn-danger' data-toggle=\"modal\" data-target=\"#staticBackdrop\" href=''  onclick=\"javascript:cargarDelPed('".$fila["id_pedido"]."')\">Eliminar</button></td>";
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
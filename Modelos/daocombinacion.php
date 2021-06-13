<?php
include 'credenciales.php';
include  'combinacion.php';
class DaoCombinacion{
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

    public function getTablaSugerencias(){
        $sql="select  combinacion.id_comb, usuario.nombre, materia_prima.nombre as Materia_Prima, detalle_combinacion.cantidad, detalle_combinacion.nombre_concentrado
        from detalle_combinacion  
        inner join combinacion  on detalle_combinacion.id_comb = combinacion.id_comb 
        inner join materia_prima on  detalle_combinacion.id_mp = materia_prima.id_mp 
        left join usuario on usuario.id_usuario = combinacion.id_usuario";
        $this->conectar();
        $resultado = $this->con->query($sql);
        $this->desconectar();

        //armar la tabla html
        $tabla= '<table class="table col-12"><thead class="table-dark"><tr><th scope="col"># Combinación</th><th scope="col">Nombre Cliente</th>
        <th scope="col">Materia Prima</th><th scope="col">Cantidad</th><th scope="col">Nombre Sugerido De Concentrado</th></tr></thead><tbody>';
    
        while($fila = mysqli_fetch_assoc($resultado)){
        $tabla.= '<tr>';
        $tabla.= '<th scope="row">'.$fila["id_comb"].'</th>';
        $tabla.='<td>'.$fila["nombre"].'</td>';
        $tabla.='<td>'.$fila["Materia_Prima"].'</td>';
        $tabla.='<td>'.$fila["cantidad"].'</td>';
        $tabla.='<td>'.$fila["nombre_concentrado"].'</td>';
    } 
                   
        $tabla.='</tr></tbody></table>';
    
        $resultado->close();
        echo $tabla;
    }

    public function eliminar($id){
        $id = $id;
        $sql ="delete from combinacion where id_comb =".$id;
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
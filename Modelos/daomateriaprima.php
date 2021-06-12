<?php
include 'credenciales.php';
include  'materiaprima.php';

class DaoMateriaPrima{
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

    public function getTablaMP(){
        $sql="select * from materia_prima having cantidad >12";
        $this->conectar();
        $resultado = $this->con->query($sql);
    
        
        $this->desconectar();
        //armar la tabla html
        $tabla= '<table class="table"><thead class="table-dark"><tr><th scope="col">Nombre Materia Prima</th><th scope="col">Cantidad (QQ)</th>
        <th scope="col">Acción</th></tr></thead><tbody>';
    
        while($fila = mysqli_fetch_assoc($resultado)){
    
        $tabla.= '<tr>';
        $tabla.= '<th scope="row">'.$fila["nombre"].'</th>';
        $tabla.='<td>'.$fila["cantidad"].'</td>';
        $tabla.= "<td><button type='button' class='btn btn-danger' data-toggle=\"modal\" data-target=\"#staticBackdrop\" href=''  onclick=\"javascript:cargarDelMP('".$fila["id_mp"]."')\">Eliminar</button> // ";
        $tabla .= "<button type='button' class='btn btn-warning text-white' data-toggle=\"modal\" data-target=\"#staticBackdrop\" href=''  onclick=\"javascript:cargarMoMP('".$fila["id_mp"]."','".$fila["nombre"]."','".$fila["cantidad"]."')\">Modificar</a></td>";
        }                                                               
    
        $tabla.='</tr></tbody></table>';
    
        $resultado->close();
        echo $tabla;
    }

    public function insertar($nombre,$cantidad){
        $mpnombre = $nombre;
        $mpcant= $cantidad;
        $sql = "insert into materia_prima values (null,'".$mpnombre."',".$mpcant." )";
        $this->conectar();

        if($this->con->query($sql)){
            echo "Ingresado Con Exito";
        }else{
            echo "Falló Al Ingresarlo";
        }
     
        $this->desconectar();
        
    }

    public function eliminar($id){
        $id = $id;
        $sql ="delete from materia_prima where id_mp=" . $id;
        $this->conectar();
        if($this->con->query($sql)){
            echo "Registro Eliminado Con Exito";
        }else{
            echo "No Se Pudo Eliminar, Intente De Nuevo";
        }
        $this->desconectar();
    }

    public function modificar($obj){
        $mp = new MateriaPrima('','');
        $mp = $obj;
        $sql ="update materia_prima set nombre='".$mp->getnombre()."', cantidad=".$mp->getcantidad()." where id_mp=". $mp->getidmp();
        $this->conectar();
        if($this->con->query($sql)){
            echo "Se Actualizó Correctamente";
        }else{
            echo "No Se Pudo Actualizar, Intente De Nuevo";
        }
        $this->desconectar();
    }

    public  function verificarMpE(){
        $sql = "select count(*) as Total from materia_prima where cantidad <=12";
        $this->conectar();
        $resultado =  $this->con->query($sql);
        $row=mysqli_fetch_row($resultado);
        $num = $row[0];
        if($num >0){
            echo "Hay Inventario Escaso, Por Favor Verificalo.";
        }else{
            echo "Bienvenido, " + $_SESSION["user"];
        }
        $this->desconectar();
    }
    
    public function getTablaMPE(){

        $sql="select * from materia_prima having cantidad <= 12 and cantidad >0 order by cantidad";
        $this->conectar();
        $resultado = $this->con->query($sql);   
        $this->desconectar();

        //armar la tabla html
        $tabla= '<table class="table"><thead class="table-dark"><tr><th scope="col">Nombre Materia Prima</th><th scope="col">Cantidad (QQ)</th>
        <th scope="col">Acción</th></tr></thead><tbody>';
    
        while($fila = mysqli_fetch_assoc($resultado)){
    
        $tabla.= '<tr>';
        $tabla.= '<th scope="row">'.$fila["nombre"].'</th>';
        $tabla.='<td>'.$fila["cantidad"].'</td>';
        $tabla .= "<td><button type='button' class='btn btn-warning text-white' data-toggle=\"modal\" data-target=\"#staticBackdrop\" href=''  onclick=\"javascript:cargarMoMP('".$fila["id_mp"]."','".$fila["nombre"]."','".$fila["cantidad"]."')\">Modificar</a></td>";
        }                                                               
    
        $tabla.='</tr></tbody></table>';
    
        $resultado->close();
        echo $tabla;
    }

}

?>
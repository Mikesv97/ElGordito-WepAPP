<?php
include 'credenciales.php';
include  'usuario.php';

class DaoUsuario{
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

    public function getUsuarios(){
        $sql="select usuario.id_usuario, usuario.nombre, usuario.correo, rol.nombre_rol from usuario inner join
        rol on usuario.id_rol = rol.id_rol";
        $this->conectar();
        $resultado = $this->con->query($sql);
        $this->desconectar();

        //armar la tabla html
        $tabla= '<table class="table col-12"><thead class="table-dark"><tr><th scope="col">Nombre Usuario</th><th scope="col">Correo De Usuario</th>
        <th scope="col">Rol</th><th scope="col">Acción</th></tr></thead><tbody>';
    
        while($fila = mysqli_fetch_assoc($resultado)){
        $tabla.= '<tr>';
        $tabla.= '<th scope="row">'.$fila["nombre"].'</th>';
        $tabla.='<td>'.$fila["correo"].'</td>';
        $tabla.='<td>'.$fila["nombre_rol"].'</td>';
        $tabla .= "<td><button type='button' class='btn btn-warning text-white' data-toggle=\"modal\" data-target=\"#staticBackdrop\" href=''  onclick=\"javascript:cargarMoUser('".$fila["id_usuario"]."','".$fila["nombre"]."','".$fila["correo"]."','".$fila["nombre_rol"]."')\">Modificar</a></td>";
    } 
                   
        $tabla.='</tr></tbody></table>';
    
        $resultado->close();
        echo $tabla;
    }

    public function modificar($id, $rol){
        $id = $id;
        $role = $rol;
        $rol=0;

      if($role=="Administrador"){
          $rol=1;
        }else{
            $rol=2;
        }

        $sql ="update usuario set id_rol=".$rol." where id_usuario =".$id;
        $this->conectar();
        if($this->con->query($sql)){
            echo "Rol De Usuario Modificado Con Exito";
        }else{
            echo "No Se Pudo Modificar, Intente De Nuevo";
        }
        $this->desconectar();
    }   
}
?>
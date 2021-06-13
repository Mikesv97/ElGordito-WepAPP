<?php
require_once '../Herramientas/mpdf/mpdf.php';
if($_POST){
    $report = $_POST["key"];
    switch($report){
        case "materiaprima":
            $con = new mysqli("localhost","root","", "elgordito");
            $sql ="select * from materia_prima";
            $res = $con->query($sql);
            $tabla ="<table border='1'><thead><tr><th>CODIGO</th><th>NOMBRE</th><th>CANTIDAD</th></tr></thead><tbody>";
            while($fila = mysqli_fetch_assoc($res)){
                $tabla .= "<tr>";
            
                $tabla .= "<td>";
                $tabla .= $fila['id_mp'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['nombre'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['cantidad'];
                $tabla .= "</td>";
            
                $tabla .= "</tr>";
            }
            $tabla .= "</tbody></table>";
            $con->close();
            $res->close();
            $reporte = new mPDF('c','A4');
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px; margin-left: 240px;'>";
            $encabezado= "<H3 style='text-align:center;'>REPORTE DE MATERIA PRIMA GENERAL</H3><hr>";
            
            $reporte->WriteHTML($logo);
            $reporte->WriteHTML($encabezado);
            $reporte->WriteHTML($tabla);
            $reporte->Output('../Reportes/ReporteMateriaPrima.pdf');

            echo "../Reportes/ReporteMateriaPrima.pdf";
        break;
        case "materiaprimaescasa":
            $con = new mysqli("localhost","root","", "elgordito");
            $sql ="select * from materia_prima where cantidad <= 12;";
            $res = $con->query($sql);
            $tabla ="<table border='1'><thead><tr><th>CODIGO</th><th>NOMBRE</th><th>CANTIDAD</th></tr></thead><tbody>";
            while($fila = mysqli_fetch_assoc($res)){
                $tabla .= "<tr>";
            
                $tabla .= "<td>";
                $tabla .= $fila['id_mp'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['nombre'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['cantidad'];
                $tabla .= "</td>";
            
                $tabla .= "</tr>";
            }
            $tabla .= "</tbody></table>";
            $con->close();
            $res->close();
            $reporte = new mPDF('c','A4');
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px; margin-left: 240px;'>";
            $encabezado= "<H3 style='text-align:center;'>REPORTE DE MATERIA PRIMA ESCASA</H3><hr>";
            
            $reporte->WriteHTML($logo);
            $reporte->WriteHTML($encabezado);
            $reporte->WriteHTML($tabla);
            $reporte->Output('../Reportes/ReporteMateriaPrimaEscasa.pdf');

            echo "../Reportes/ReporteMateriaPrimaEscasa.pdf";
        break;
        case "mezclas":
            $con = new mysqli("localhost","root","", "elgordito");
            $sql ="	select  combinacion.id_comb, usuario.nombre, materia_prima.nombre as Materia_Prima, detalle_combinacion.cantidad, detalle_combinacion.nombre_concentrado
            from detalle_combinacion  
            inner join combinacion  on detalle_combinacion.id_comb = combinacion.id_comb 
            inner join materia_prima on  detalle_combinacion.id_mp = materia_prima.id_mp 
            left join usuario on usuario.id_usuario = combinacion.id_usuario";
            $res = $con->query($sql);
            $tabla ="<table border='1'><thead><tr><th>CODIGO</th><th>NOMBRE USUARIO</th>
            <th>NOMBRE MAERIA PRIMA</th><th>CANTIDAD</th></tr><th>NOMBRE CONCENTRADO</th></thead><tbody>";
            while($fila = mysqli_fetch_assoc($res)){
                $tabla .= "<tr>";
            
                $tabla .= "<td>";
                $tabla .= $fila['id_comb'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['nombre'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['Materia_Prima'];
                $tabla .= "</td>";

                $tabla .= "<td>";
                $tabla .= $fila['cantidad'];
                $tabla .= "</td>";

                $tabla .= "<td>";
                $tabla .= $fila['nombre_concentrado'];
                $tabla .= "</td>";
            
                $tabla .= "</tr>";
            }
            $tabla .= "</tbody></table>";
            $con->close();
            $res->close();
            $reporte = new mPDF('c','A4');
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px; margin-left: 240px;'>";
            $encabezado= "<H3 style='text-align:center;'>REPORTE DE COMBINACIONES SUGERIDAS</H3><hr>";
            
            $reporte->WriteHTML($logo);
            $reporte->WriteHTML($encabezado);
            $reporte->WriteHTML($tabla);
            $reporte->Output('../Reportes/ReporteMezclas.pdf');

            echo "../Reportes/ReporteMezclas.pdf";
        break;
        case "cargaruser":
            $con = new mysqli("localhost","root","", "elgordito");
            $sql ="select id_usuario, nombre from usuario where id_rol =2";
            $res = $con->query($sql);
            $opciones ="";
            while($fila = mysqli_fetch_assoc($res)){
                $opciones .= "<option value='" . $fila['id_usuario'] . "'>". $fila['nombre'] . "</option>";
            }
         echo $opciones;
            
        break;
        case "cargarfecha":
            $con = new mysqli("localhost","root","", "elgordito");
            $sql ="select DISTINCT fecha from detalle_pedido";
            $res = $con->query($sql);
            $opciones ="";
            while($fila = mysqli_fetch_assoc($res)){
                $opciones .= "<option value='" . $fila['fecha'] . "'>". $fila['fecha'] . "</option>";
            }
         echo $opciones;
            
        break;
        case "pedidos":
            $user= $_POST["user"];
            $fecha=$_POST["fecha"];
        
            $con = new mysqli("localhost","root","", "elgordito");
            $sql ="	select detalle_pedido.id_detalle, pedidos.id_pedido, usuario.nombre, concentrados.nombre as concentrado, detalle_pedido.cantidad, detalle_pedido.fecha 
        from detalle_pedido  
        inner join pedidos  on detalle_pedido.id_pedido = pedidos.id_pedido 
        inner join concentrados on  detalle_pedido.id_concentrado = concentrados.id_concentrado 
        left join usuario on usuario.id_usuario = pedidos.id_usuario where pedidos.id_usuario =".$user." and 
        detalle_pedido.fecha ='".$fecha."'";

            $res = $con->query($sql);
            $tabla ="<table border='1'><thead><tr><th># DETALLE</th><th># PEDIDO</th>
            <th>NOMBRE CLIENTE</th><th>CONCENTRADO</th></tr><th>CANTIDAD</th></tr><th>FECHA</th></thead><tbody>";
            while($fila = mysqli_fetch_assoc($res)){
                $tabla .= "<tr>";
            
                $tabla .= "<td>";
                $tabla .= $fila['id_detalle'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['id_pedido'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['nombre'];
                $tabla .= "</td>";

                $tabla .= "<td>";
                $tabla .= $fila['concentrado'];
                $tabla .= "</td>";

                $tabla .= "<td>";
                $tabla .= $fila['cantidad'];
                $tabla .= "</td>";

                $tabla .= "<td>";
                $tabla .= $fila['fecha'];
                $tabla .= "</td>";
            
                $tabla .= "</tr>";
            }
            $tabla .= "</tbody></table>";
            $con->close();
            $res->close();
            $reporte = new mPDF('c','A4');
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px; margin-left: 240px; margin-left: 240px;'>";
            $encabezado= "<H3 style='text-align:center;'>REPORTE DE PEDIDOS SEGÚN FECHA Y CLIENTE</H3><hr>";
            
            $reporte->WriteHTML($logo);
            $reporte->WriteHTML($encabezado);
            $reporte->WriteHTML($tabla);
            $reporte->Output('../Reportes/ReportePedidos.pdf');

            echo "../Reportes/ReportePedidos.pdf";
            
        break;
        case "solicitudes":
            $user= $_POST["user"];
            $fecha=$_POST["fecha"];
        
            $con = new mysqli("localhost","root","", "elgordito");
            $sql ="select * from materia_prima where cantidad <= 12";

            $res = $con->query($sql);
            $tabla ="<table border='1'><thead><tr><th>NOMBRE MATERIAL</th><th>CANTIDAD A SOLICITAR(QQ)</th>
            </thead><tbody>";
            while($fila = mysqli_fetch_assoc($res)){
                $tabla .= "<tr>";
            
                $tabla .= "<td>";
                $tabla .= $fila['nombre'];
                $tabla .= "</td>";
            
                $tabla .= "<td>";
                $tabla .= $fila['cantidad'] * 50;
                $tabla .= "</td>";
              
                $tabla .= "</tr>";
            }
            $tabla .= "</tbody></table>";
            $con->close();
            $res->close();
            $reporte = new mPDF('c','A4');
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px; margin-left: 240px;'>";
            $encabezado= "<H2 style='text-align:center;'>SOLICITUD DE MATERIA PRIMA</H2>";
            $proveedor="<H3 style='color:red; text-align:center;'>BRSP S.A DE C.V</H3><hr>";
            $texto= "<p>Por Este Medio Nosotros El Gordito, Solicitamos El Abastecimiento De Los Siguientes Productos:</p>";

            $reporte->WriteHTML($logo);
            $reporte->WriteHTML($encabezado);
            $reporte->WriteHTML($proveedor);
            $reporte->WriteHTML($texto);
            $reporte->WriteHTML($tabla);
            $reporte->Output('../Reportes/solicitudmateria.pdf');

            echo "../Reportes/solicitudmateria.pdf";
            
        break;
    }


}

?>
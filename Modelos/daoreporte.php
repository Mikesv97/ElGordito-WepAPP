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
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px;'>";
            $encabezado= "<H3>REPORTE DE MATERIA PRIMA GENERAL</H3><hr>";
            
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
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px;'>";
            $encabezado= "<H3>REPORTE DE MATERIA PRIMA ESCASA</H3><hr>";
            
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
            $logo = "<img  src='../Herramientas/imagenes/logofot.png' style='width: 200px; height: 200px;'>";
            $encabezado= "<H3>REPORTE DE COMBINACIONES SUGERIDAS</H3><hr>";
            
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
    }


}

?>
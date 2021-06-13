<?php
session_start();

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Herramientas/miestilo.css">
    <script   src="../Herramientas/jquery-3.6.0.js"></script>
    <script   src="../Herramientas/myquery.js"></script>
    <title>Bienvenidos</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-center">
    <h1 class="text-white" >Por Favor Identidicate</h1>
</nav>
<div style="width:400px; height:368px; margin:0 auto;">
    <form class="form-group" method="post" action="login.php" id ="miform">
         <br><label id="lbname" for="nombremp" class="form-label">Correo Electronico</label>
          <input placeholder="Ingresa Tu Correo" type="text" class="form-control"  name="nombre" required>
          <div id="helplbname" class="form-text">Ingresa El Correo Con El Que Te Registraste</div><br>
          <label id="lbname" for="nombremp" class="form-label">Contraseña</label>
          <input placeholder="Ingresa Tu Contraseña" type="password" class="form-control"  name="pass" required>
          <div id="helplbname" class="form-text">Ingresa Tu Contraseña</div><br>
          <input type="submit" id="btnlogin" name="btnlogin" value="Aceptar" class="btn btn-dark" ><br>
    </from>

</div>
<div class="container-fluid bg-dark text-white">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 text-center margint navbar navbar-fixed-bottom">
            <h1 class="margintf">Concentrados El Gordito &copy;</h1>
            <p>Gracias Por Preferir Nuestros Concentrados, Todos Los Derechos Reservados<br>
            Proyecto Final Ciclo I-2021 || Tec.Ing.Sistemas Informáticos<br>
            Diseño De Aplicaciones Web
            </p>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 text-center margint">
            <img src="../Herramientas/imagenes/logofot.png" class="logo">
        </div>
    </div>
<div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  </body>
</html>
<?php

if($_POST){
    if(isset($_POST["btnlogin"])){
       $nombre = $_POST["nombre"];
       $pass = $_POST["pass"];

       $con = new mysqli("localhost","root","", "elgordito");
       $sql ="select * from usuario where correo='".$nombre."' and contraseña ='".$pass."'";
       $res = $con->query($sql);
       $rol =mysqli_fetch_assoc($res);


       if($rol["id_rol"]==1){
           $_SESSION["usuario"]=$rol["nombre"];
           $_SESSION["rol"]="Administrador";
           header("location:../index.php");
       }else if($rol["id_rol"] ==2){
        $_SESSION["usuario"]=$rol["nombre"];
        $_SESSION["rol"]="Cliente";
        $_SESSION["id"]=$rol["id_usuario"];
        header("location:../index.php");
       }else{
           echo "<script>swal.fire('Datos Invalidos, Intenta De Nuevo')</script>";
       }
    }
}

if(isset($_REQUEST["cerrar"])){
    session_destroy();
    header("location:login.php");
}

?>
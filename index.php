<?php
session_start();

include 'Modelos/daomateriaprima.php';
$mp= new DaoMateriaPrima();

$_SESSION["user"] = "Maria Melissa";
$_SESSION["rol"]="Cliente";
$_SESSION["id"]="5";


$usuario=$_SESSION["user"];
$rol = $_SESSION["rol"];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Herramientas/miestilo.css">
    <script   src="Herramientas/jquery-3.6.0.js"></script>
    <script   src="Herramientas/myquery.js"></script>
    <script>
    /*OBTENGO VALORES DE ROL DE PHP EN JS PARA OCULTAR DIVS SEGÚN ROL */
      var rol ="";
      rol = "<?php echo $rol ?>"
      if(rol == "Administrador"){
        role ="Administrador";
        pag="adminmp";
      }else{
        role ="Cliente";
        pag="indexcliente";        
      }    
    </script>
    <title>Bienvenidos</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand btn btn-danger" href="index.php">El Gordito</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <?php 
        if($rol == "Administrador"){
        echo '<a id="mp" class="nav-link" href="index.php">Materia Prima</a>';
        echo '<a class="nav-link" href="Vistas/gestionpedidos.php">Gestión De Pedidos</a>';
        echo '<a class="nav-link" href="Vistas/sugerenciasconcentrado.php">Sugerencias Concentrados</a>';
        echo '<a class="nav-link" href="Vistas/usuarios.php">Usuarios</a>';
        echo '<a class="nav-link" href="Vistas/reportes.php">Reportes</a>';
        }else{
        echo '<a class="nav-link" href="index.php">Concentrado</a>';
        echo '<a id="btnPedidos" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Realizar Pedido</a>';
        echo '<a id="btnComb" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Sugerir Combinación</a>';
        }?>
      </div>
    </div>
  </div>
</nav>
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="2200">
    <img src="Herramientas/imagenes/banner1.jpg" class="img-banner d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="2200">
    <img src="Herramientas/imagenes/banner2.jpg" class="img-banner d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="2200">
    <img src="Herramientas/imagenes/banner3.jpg" class="img-banner d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!--PARA VISTA ADMIND-->
<div id="admin" class="container-fluid ">
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center navbar-dark bg-dark">
            <h1 class="text-white">Bienvenido <?php echo $usuario?></h1>
        </div>
    </div>
    <div class="row">
        <div id="contentmp" class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 text-center margint">
            <h2 class="bg-dark text-white margint">Materia Prima Disponible</h2>
            <a id="btnNewMp" class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Nueva Materia Prima</a>
            <div id="tablamp" class="col-12 offset-lg-12"></div>
          </div>
        <div class="col-12 col-sm-13 col-md-12 col-lg-4 col-xl-4  offset-lg-1 text-center  margint">
            <h2 class="bg-dark text-white margint">Materia Prima Escasa</h2 >
            <div id="tablampe" ></div>
        </div>
    </div>
</div>
<!--PARA VISTA CLIENTE-->
<div id="cliente" class="container-fluid ">
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-dark">
            <h1 class="text-white">Bienvenido <?php echo $usuario?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center margint">
            <h2 class="bg-dark text-white margint">Estos Son Nuestros Productos Para Ti</h2>
            <div id="tablacon" class="col-12 offset-lg-12"></div>
        </div>
    </div>
</div>
<!--PIE DE PAGINA-->
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
            <img src="Herramientas/imagenes/logofot.png" class="logo">
        </div>
    </div>
<div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="bg-dark modal-header">
        <h5 class="modal-title text-white" id="staticBackdropLabel">Por Favor Llena La Información</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="post" id ="miform">
          <input type="text" class="form-control" id="idmp" name="idmp"><br>
          <label id="lbname" for="nombremp" class="form-label bg-secondary">Nombre Materia Prima</label>
          <input placeholder="Nombre Materia Prima" type="text" class="form-control" id="nombremp" name="nombremp" required>
          <div id="helplbname" class="form-text">Ingresa Un Nombre De La Materia Prima</div><br>
          <label id="lbcant" for="cantmp" class="form-label bg-secondary">Cantidad Materia Prima</label>
          <input id="cantmp" type="number" value="0" class="form-control" name="cantmp" required>
          <div id="helplbcant" class="form-text">Ingresa La Cantidad a Ingresar De Materia Prima</div><br>
          <div id="selectindex">
          <label id="lbconcentrado" for="concentrado" class="form-label bg-secondary">Concentrado</label>
                &nbsp;&nbsp;&nbsp;
                <select name="concentrado" id="concentrado" class="form-select" style="width:400px;">
                </select><br> 
          </div>
          <button type="button" id="btnModal" class="btn btn-dark" >Aceptar</button>
        </from>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>      
      </div>
    </div>
  </div>
</div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  </body>
</html>
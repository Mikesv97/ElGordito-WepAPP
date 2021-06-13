<?php
session_start();

$usuario=$_SESSION["usuario"];
$rol = $_SESSION["rol"];
?>
<?php
include '../Modelos/header.php';
?>
<script>
    var rol ="";
    rol = "<?php echo $rol ?>"
    if(rol == "Administrador"){
          role ="Administrador";
          pag="sugerenciascomb";
    }else{
          role ="cliente";         
    }
</script>
<title>Sugerencias De Nuevas Combinaciones</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand btn btn-danger" href="../index.php">El Gordito</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <?php 
        if($rol == "Administrador"){
        echo '<a id="mp" class="nav-link" href="../index.php">Materia Prima</a>';
        echo '<a class="nav-link" href="gestionpedidos.php">Gestión De Pedidos</a>';
        echo '<a class="nav-link" href="sugerenciasconcentrado.php">Sugerencias Concentrados</a>';
        echo '<a class="nav-link" href="usuarios.php">Usuarios</a>';
        echo '<a class="nav-link" href="reportes.php">Reportes</a>';
        }else{
        echo '<a class="nav-link" href="#">Concentrado</a>';
        echo '<a id="btnPedidos" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Realizar Pedido</a>';
        echo '<a class="nav-link" href="#">Sugerir Combinación</a>';
        }?>
        <a class="nav-link" href="login.php?cerrar=true;">Salir</a>
      </div>
    </div>
  </div>
</nav>
<div id="datasugerencias" class="container-fluid ">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-dark margintf2 text-white">
                <h1 class="text-white">Detalle Sugerencias Para Combinar Concentrados</h1>
            </div>
        </div>
        <div class="row">
        <div id="contentmp" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center margint">
             <a id="btnEliminarSug" class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Eliminar Sugerencia</a>
            <div id="infosugerencias" class="col-12 offset-lg-12"></div>
          </div>
              <div class="alert alert-danger" role="alert">
               <span class="btn-dark">NOTA:</span>&nbsp;&nbsp;Al Eliminar Un Registro, Se Da Por Entendido
               Que Este Ya Fué Puesto En Producción.
            </div>
            </div>
        </div>
</div><br>
<?php
include '../Modelos/footer.php';
?>
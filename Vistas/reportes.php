<?php
include '../Modelos/credenciales.php';

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
          pag="reportes";
    }else{
          role ="cliente";         
    }
</script>
<title>Reportes</title>
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
<div id="datausuarios" class="container-fluid ">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-dark margintf2 text-white">
                <h1 class="text-white">Generar Reportes</h1>
        </div>
    </div>
    <div class="row">
        <div id="contentusuarios" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center margint">
            <div id="infousuarios" class="col-12 offset-lg-12">
                <label for="reportes" class="form-label"><strong>SELECCIONA EL TIPO DE REPORTE</strong></label>
                &nbsp;&nbsp;&nbsp;
                <select name="Reportes" id="Reportes" class="form-select" style="width:300px; margin:0 auto">
                <option value="materiaprima">Materia Prima</option>
                <option value="materiaprimaescasa">Materia Prima Escasa</option>
                <option value="mezclas">Mezclas</option>
                <option value="pedidos">Pedidos</option>
                <option value="solicitudes">Solicitudes</option>
                </select><br>
                <label id="lbuser" for="cliente" class="form-label"><strong>SELECCIONA EL CLIENTE</strong></label>
                &nbsp;&nbsp;&nbsp;
                <select name="Reportes" id="cliente" class="form-select" style="width:300px; margin:0 auto">
                </select><br> 
                <label id="lbfecha" for="fecha" class="form-label"><strong>SELECCIONA LA FECHA</strong></label>
                &nbsp;&nbsp;&nbsp;
                <select name="Reportes" id="fecha" class="form-select" style="width:300px; margin:0 auto">
                </select><br> 
                <button type="button" id="btnReporte" class="btn btn-dark " >Aceptar</button>
                <br>
                <br>
                <iframe id="contenreport" src="" style="width: 80%; height: 500px;" scrolling="yes">
            </div>
        </div>
    </div>
 </div><br>
<?php
include '../Modelos/footer.php';
?>

<?php
session_start();
$_SESSION["user"] = "Douglas Miguel";
$_SESSION["rol"]="administrador";

$usuario=$_SESSION["user"];
$rol = $_SESSION["rol"];
?>
<?php
include '../Modelos/header.php';
?>
<script>
    var rol ="";
    rol = "<?php echo $rol ?>"
    if(rol == "administrador"){
          role ="administrador";
          pag="usuarios";
    }else{
          role ="cliente";         
    }
</script>
<title>Listado De Usuarios</title>
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
        if($rol == "administrador"){
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
      </div>
    </div>
  </div>
</nav>
<div id="datausuarios" class="container-fluid ">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-dark margintf2 text-white">
                <h1 class="text-white">Listado De Todos Los Usuarios Registrados</h1>
            </div>
        </div>
        <div class="row">
        <div id="contentusuarios" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center margint">
            <div id="infousuarios" class="col-12 offset-lg-12"></div>
          </div>
              <div class="alert alert-danger" role="alert">
               <span class="btn-dark">NOTA:</span>&nbsp;&nbsp;Solo Puedes Cambiar Rol De Un Usuario, No Puedes Eliminarlo, Ten
               En Cuenta Que Si Asignas Rol Administrador A Un Usuario Con Rol Cliente, Este Podrá Ver Toda La Información Del Sistema,
               , Por Favor No Olvides Esto.
            </div>
            </div>
        </div>
</div><br>
<?php
include '../Modelos/footer.php';
?>
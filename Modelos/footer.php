<!--PIE DE PAGINA-->
<div class="container-fluid bg-dark text-white fot">
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
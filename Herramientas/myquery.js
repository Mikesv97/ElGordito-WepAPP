//VARIABLES GLOBALES A USAR
var action = "";
var role="";
var pag ="";

//FUNCIONES GLOBALES A USAR EN JS

 function cargartableMP(){
    $.ajax({
    url: 'Controlador/controladormp.php',
    type: 'POST',
    data: {key:"getTablaMP"}
}).done(function(resp){
    $("#tablamp").empty();
    $("#tablamp").append(resp);
}).fail(function(){
    console.log("error");
});
}//FINAL FUNCION CARGARTABLAMP

function cargarDelMP(id){
    var id = id;
    Swal.fire({
        title: 'Estas Seguro De Eliminar Este Registro?',
        text: "No Podrás Deshacer Este Paso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminarlo!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "Controlador/controladormp.php",
                type: "post",
                data: {key:"EliminarMp", data: id}
            }).done(function(resp){
        
               Swal.fire(resp);
               $("#miform")[0].reset();
               $('#staticBackdrop').modal('hide');
               cargartableMP();
            }).fail(function(){
                Swal.fire("Algo Salió Mal, Intentalo De Nuevo");
            });//final de ajax eliminarmp
        }//final de if del sweet alert
      });//final del sweet alert de consulta eliminar
}//final funcion cargardel

function cargarMoMP(id,nombre,cantidad){
    action="modmp";
    var id=id;
    var nombre = nombre;
    var cantidad = cantidad;

    
    $("#idmp").val(id);
    $("#idmp").attr("readonly", true);
    document.getElementById("nombremp").value=nombre;
    document.getElementById("cantmp").value=cantidad;
    $("#staticBackdrop").modal("show");



}//final funcion cargarMo

function comprobarInvMP(){

    $.ajax({
        url: 'Controlador/controladormp.php',
        type: 'POST',
        data: {key:"verificarMp"}
    }).done(function(resp){
        swal.fire('BIENVENIDO',resp, 'info');
    }).fail(function(){
        console.log("error");
    });

}//FINAL VERIFICAR INVENTARIO ESCASO

function cargartablempe(){

        $.ajax({
        url: 'Controlador/controladormp.php',
        type: 'POST',
        data: {key:"getTablaMPE"}
    }).done(function(resp){
        $("#tablampe").empty();
        $("#tablampe").append(resp);
    }).fail(function(){
        console.log("error");
    });
    
}//FINAL FUNCION CARGAR TABLE INVENTARIO ESCASO

function cargarpedidos(){
    $.ajax({
        url: '../Controlador/controladorpedidos.php',
        type: 'POST',
        data: {key:"getTablaPed"}
    }).done(function(resp){
        $("#infopedido").empty();
        $("#infopedido").append(resp);
    }).fail(function(){
        console.log("error");
    });
}//FINAL FUNCION CARGAR PEDIDOS DE CLIENTES

function cargarDelPed(id){
    var id = id;
    Swal.fire({
        title: 'Estas Seguro De Eliminar Este Registro?',
        text: "No Podrás Deshacer Este Paso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminarlo!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../Controlador/controladorpedidos.php",
                type: "post",
                data: {key:"EliminarPed", data: id}
            }).done(function(resp){
                Swal.fire(resp);
               cargarpedidos();
            }).fail(function(){
                Swal.fire("Algo Salió Mal, Intentalo De Nuevo");
            });//final de ajax eliminarmp
        }//final de if del sweet alert
      });//final del sweet alert de consulta eliminar

}//FINAL FUNCION CARGARDEL PEDIDOS

function cargarsugerencias(){
    $.ajax({
        url: '../Controlador/controladorsugerencias.php',
        type: 'POST',
        data: {key:"getTablaSug"}
    }).done(function(resp){
       $("#infosugerencias").empty();
       $("#infosugerencias").append(resp);
    }).fail(function(){
        console.log("error");
    });
}//FINAL FUNCION CARGAR SUGERENCIAS

function cargarusuarios(){
    $.ajax({
        url: '../Controlador/controladorusuario.php',
        type: 'POST',
        data: {key:"getUsuarios"}
    }).done(function(resp){

         $("#infousuarios").empty();
         $("#infousuarios").append(resp);
    }).fail(function(){
        console.log("error");
    });

}//FINAL FUNCION CARGAR USUARIOS

function  cargarMoUser(id,nombre,correo, rol){
    var id = id;
    var nombre= nombre;
    var correo = correo;
    var rol = rol;

   if(rol =="Cliente"){
        
        $("#rol1").attr('checked', 'checked');
   
      }
      
      if(rol=="Administrador"){
          
        $("#rol2").attr('checked', 'checked');
      }

    $("#idmp").val(id);
    $("#lbname").text("Selecciona Un Rol Para El Usuario");
    $("#nombremp").hide();
    $("#helplbname").hide();
    $("#lbcantmp").hide();
    $("#lbcant").hide();
    $("#cantmp").hide();
    $("#helplbcant").hide();
    $("#rad").show();
    $("#staticBackdrop").modal("show");

}//FINAL FUNCION CARGAR MODIF USUARIO

function cargarproductos(){
    $.ajax({
        url: 'Controlador/controladorclientes.php',
        type: 'POST',
        data: {key:"getProductos"}
    }).done(function(resp){

        $("#tablacon").empty();
        $("#tablacon").append(resp);
    }).fail(function(){
        console.log("error");
    });
}//FIN CARGAR PRODUCTOS

function cargarcmbconcentrado(){
    $.ajax({
        url: 'Controlador/controladorclientes.php',
        type: 'POST',
        data: {key:"getConcentrados"}
    }).done(function(resp){
        
        $("#concentrado").empty();
        $("#concentrado").append(resp);
    }).fail(function(){
        console.log("error");
    });
}//FIN CARGAR CMB CONCENTRADOS

/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/

//TODO EL CODIGO PARA JQUERY CUANDO EL DOM ESTE CARGADO COMPLETAMENTE
$(document).ready(function(){
    $("#idmp").hide();
    $("#rad").hide();

    if(role=="Administrador"){ //CONTROLAMOS EVENTOS JS SEGÚN ADMIN
        if(pag=="adminmp"){ //EVALUAMOS EN QUE PAG DE VISTA ADMIN ESTA
            $("#cliente").hide();//EJECUTAMOS ACCION PARA PAG MP DE ADMIN
                cargartableMP();
                comprobarInvMP();
                cargartablempe()

                $("#btnNewMp").on("click",function(){
                $("#btnModal").attr("value","Ingresar Materia Prima");
                action ="nuevamp";
                
                $("#miform")[0].reset();
            });//END BTNewMp BOTON CLICK
    
         //CONTROLAR EL BOTON MODAL QUE OPCION TIENE PARA ASÍ EJECUTAR UN PROCEDIMIENTO
         //EJEMPPLO NUEVAMATERIAPRIMA, NUEVOPEDIDO, ETC PARA SOLO TENER UN MODAL
           $("#btnModal").on("click",function(){
            if(action =="nuevamp"){
                
                var nombre= $("#nombremp").val();
                var cant = $("#cantmp").val();
    
    
              if(nombre == "" && cant == 0){
                     
                    Swal.fire('Llena Los Campos', 'No Pueden Haber Campos Vacios','error');
    
                }else{
                    var form = $("#miform").serialize();
                    $.ajax({
                        url: "Controlador/controladormp.php",
                        type: "post",
                        data: {key:"NuevaMp", data: form}
                    }).done(function(resp){
    
                    Swal.fire(resp);
                    $("#miform")[0].reset();
                    $('#staticBackdrop').modal('hide');
                    cargartableMP();
                    cargartablempe();
    
                    }).fail(function(){
                        Swal.fire("Algo Salió Mal, Intentalo De Nuevo");
                    });
                }
            }//final de caso newmp
    
            if(action=="modmp"){
                if(nombre == "" && cant == 0){
                     
                    Swal.fire('Llena Los Campos', 'No Pueden Haber Campos Vacios','error');
    
                }else{
                    var form = $("#miform").serialize();
                    $.ajax({
                        url: "Controlador/controladormp.php",
                        type: "post",
                        data: {key:"ModMp", data: form}
                    }).done(function(resp){
    
                    Swal.fire(resp);
                    $("#miform")[0].reset();
                    $('#staticBackdrop').modal('hide');
                    cargartableMP();
                    cargartablempe();
    
                    }).fail(function(){
                        Swal.fire("Algo Salió Mal, Intentalo De Nuevo");
                    });
    
    
                }
           }//final de caso modmp
    
         });//END BTNMODAL BOTON CLICK
        }//END PAG ADMIN MP

        if(pag=="gestionped"){//EVALUAMOS PAGINA EN QUE ESTA EL ADMIN
            cargarpedidos();//EJECUTAMOS ACCION PARA ESA PAGINA
        }//FINAL PAG GESTION PEDIDOS

        if(pag=="sugerenciascomb"){//EVALUAMOS PAGINA EN QUE ESTA EL ADMIN
          cargarsugerencias();  //EJECUTAMOS ACCION PARA ESA PAGINA

          $("#btnEliminarSug").on("click",function(){//EVENTO CLICK PARA ELIMINAR UNA SUGERENCIA

            $("#idmp").show();
            $("#idmp").attr("readonly", false);
            $("#idmp").attr("type", "number");
            $("#lbname").text("Ingresa El Numero De La Sugerencia De Combinación a Eliminar");
            $("#nombremp").hide();
            $("#lbcant").hide();
            $("#cantmp").hide();
            $("#helplbcant").hide();
            $("#helplbname").hide();
            
          });//FINAL EVENTO CLICK ELIMINAR REGISTRO (LLAMAR MODAL)

          $("#btnModal").on("click",function(){
            var id = $("#idmp").val();
            if(id==0 || id < 0){
                     
                Swal.fire('Llena Los Campos', 'No Pueden Haber Campos Vacios, Ni Con Números Negativos','error');

            }else{
                Swal.fire({
                    title: 'Estas Seguro De Eliminar Este Registro?',
                    text: "No Podrás Deshacer Este Paso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminarlo!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "../Controlador/controladorsugerencias.php",
                            type: "post",
                            data: {key:"eliminarSug", data: id}
                        }).done(function(resp){
        
                        Swal.fire(resp);

    

                        $("#miform")[0].reset();
                        $('#staticBackdrop').modal('hide');
                        cargarsugerencias();
                        }).fail(function(){
                            Swal.fire("Algo Salió Mal, Intentalo De Nuevo");
                        });
                    }//final de if del sweet alert
                });//FINAL SWEET ALERT PREGUNTAR CONFIRM DEL
            }//FINAL DEL ELSE DEL IF DE CAMPOS VACIOS
            });//FINAL DE CLICK BOTON ELIMINAR
        }//FINAL PAG GESTION PEDIDOS

        if(pag=="usuarios"){
            cargarusuarios();

            $("#btnModal").on("click",function(){
                var id = $("#idmp").val();
                var form = $("#miform").serialize();
                    Swal.fire({
                        title: 'Estas Seguro De Modificar El Rol De Este Usuario?',
                        text: "Solo Si Estas Seguro Continua!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Modifcarlo!'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "../Controlador/controladorusuario.php",
                                type: "post",
                                data: {key:"editaruser", data: form, id:id}
                            }).done(function(resp){
                            Swal.fire(resp);
                            $("#miform")[0].reset();
                            $('#staticBackdrop').modal('hide');
                            cargarusuarios();
                            
                            }).fail(function(){
                                Swal.fire("Algo Salió Mal, Intentalo De Nuevo");
                            });
                        }//final de if del sweet alert
                    });//FINAL SWEET ALERT PREGUNTAR CONFIRM DEL
                });//FINAL DE CLICK BOTON ELIMINAR
        }//FINAL PAG USUARIOS

        if(pag=="reportes"){
            $("#fecha").hide();
            $("#cliente").hide();
            $("#lbfecha").hide();
            $("#lbuser").hide();
            //PARA CARGAR USUARIOS EN CMB
            $.ajax({
                url: '../Modelos/daoreporte.php',
                type: 'POST',
                data: {key: "cargaruser"}
            }).done(function(resp){
           
                 $("#cliente").empty();
                $("#cliente").append(resp);
            }).fail(function(){
                console.log("error");
            });//FIN CARGAR USUARIOS CMB

            $.ajax({//CARGAR FECHAS CMB
                url: '../Modelos/daoreporte.php',
                type: 'POST',
                data: {key: "cargarfecha"}
            }).done(function(resp){
                
                 $("#fecha").empty();
                $("#fecha").append(resp);
            }).fail(function(){
                console.log("error");
            });//FIN CARGAR FECHA CMB

            //ACTIVAR CMB USUARIO Y FECHA PARA REPORTE PEDIDOS
            $("#Reportes").change(function() {
                var selec = $("#Reportes").val();
                if(selec=="pedidos"){
                    $("#lbfecha").show();
                    $("#cliente").show();
                    $("#fecha").show();
                    $("#lbuser").show();
                }else{
                    $("#fecha").hide();
                    $("#cliente").hide();
                    $("#lbfecha").hide();
                    $("#lbuser").hide();

                }
            });//FIN CMB ACTIVAR USUARIO Y FEHCHA

            //CLICK BTN REPORTE
           $("#btnReporte").on("click",function(){
               var reporte = $("#Reportes").val();
               if(reporte=="pedidos"){
                var user =$("#cliente").val();
                var fecha = $("#fecha").val();
                $.ajax({
                    url: '../Modelos/daoreporte.php',
                    type: 'POST',
                    data: {key: reporte, user: user, fecha:fecha}
                }).done(function(resp){
                   
                     $("#contenreport").attr("src","");
                   $("#contenreport").attr("src",resp);
                }).fail(function(){
                    swall.fire("Cliente Sin Pedidos","El Cliente No Ha Hecho Pedidos En Esa Fecha","info");
                });//FIN AJAX REPORTE
               }else{
                $.ajax({
                    url: '../Modelos/daoreporte.php',
                    type: 'POST',
                    data: {key: reporte}
                }).done(function(resp){
                     $("#contenreport").attr("src","");
                    $("#contenreport").attr("src",resp);
                }).fail(function(){
                    console.log("error");
                });//FIN AJAX REPORTE
               }
            
           });//FIN BTN REPORTE
        }//FIN PAG REPORTE
    }else{
        if(pag=="indexcliente"){
            $("#admin").hide();
            $("#selectindex").hide();
            cargarproductos();
            cargarcmbconcentrado();

            $("#btnPedidos").on("click",function(){
                $("#selectindex").show();
                $("#lbname").hide();
                $("#nombremp").hide();
                $("#helplbname").hide();
                $("#lbcant").text("Ingresa Cantidad A Pedir");
                $("#helplbcant").text("La Cantidad Se Maneja En Quintales (qq)");
                action="newpedido";      
                
                $("#btnModal").on("click",function(){
                    var cantidad =  $("#cantmp").val();
                    var concentrado = $("#concentrado").val();
        
                    if(cantidad<0 || cantidad==0){
                        swal.fire("No Pueden Haber Campos Vacios O Negativos");
                    }else{
                        var form = $("#miform").serialize();
                        $.ajax({
                            url: 'Controlador/controladorclientes.php',
                            type: 'POST',
                            data: {key:"NewPedido", data:form}
                        }).done(function(resp){
                            swal.fire("Ingresado Con Exito",resp,"info");
                            $("#miform")[0].reset();
                            $('#staticBackdrop').modal('hide');
                        }).fail(function(){
                            console.log("error");
                        });
                    }
                });
    
            });
            
        }
    }
});
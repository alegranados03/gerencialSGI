
$(document).ready(function(){
    $("#btnGenerarReporte").click(function(){
      var datos = $('#form').serialize();
      var fechaInicio = new Date($("#fechaInicio").val());
      var fechaFin = new Date($("#fechaFin").val());
      var hoy = new Date();
      hoy.setDate(hoy.getDate())
      if($("#fechaInicio").val() != "" && $("#fechaFin").val() != "" ){
        if(fechaInicio <= fechaFin){
          if(fechaFin <= hoy){
            if($("#numeroIntervalos").val()>1 && $("#numeroIntervalos").val()<=30 ){
              if($("#rangoEntreIntervalos").val()>=1){
                esconderAlertas();
                $.ajax({
                  url:"/ajaxRequestProducto_P2T",
                  type:"GET",
                  data: datos,
                  success: function(data){
                    var datosExcel = data;
                    var fecha1 = document.getElementById('fechaInicio').value;
                    var fecha2 = document.getElementById('fechaFin').value;
                    if(data ==""){
                        bloquearBotones();
                        limpiarRedireccion();
                    }else{
                      $("#reporte-info").empty();
                          desplegarBotones();
                          var elemento = data[0];
                          var headers = new Array();
                          var titulo = $("#titulo").text();
                          var headers = obtenerCabeceras(data[0]);
                          $("#jsonExcel").val(JSON.stringify(datosExcel));
                          $("#keys").val(headers.toString());
                          $("#tituloExcel").val(titulo);
                          $("#fechaInicio2").val($("#fechaInicio").val());
                          $("#fechaFin2").val($("#fechaFin").val());
                          $("#json").val(JSON.stringify(datosExcel));
                          $("#tituloReporte").val(titulo);                      
                          $.each(data,function(i,value){
                              var tr=$("<tr/>");
                              tr.append($("<td/>",{
                                text: value.rango
                              })).append($("<td/>",{
                                text: value.cantidad
                              })).append($("<td/>",{
                                text: value.ingresos
                              }))
                              $("#reporte-info").append(tr);
                            });
                    }
                  }
                });
              }else{
                bloquearBotones();
                limpiarRedireccion();
                rangoMinimo();
              }
            }else{
              bloquearBotones();
              limpiarRedireccion();
              intervaloMinimo();
            }
            
          }else{
              bloquearBotones();
              limpiarRedireccion();
              menorQueFechaActual();
          }
        }else{
            bloquearBotones();
            limpiarRedireccion();
            fechasNoCongruentes();
        }
      }else{
        bloquearBotones();
        limpiarRedireccion();
        camposFechaVacios();
    }
    });
  });

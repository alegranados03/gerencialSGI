
$(document).ready(function(){
    $("#btnGenerarReporte").click(function(){
      var datos = $('#form').serialize();
      $("#fechaInicioBtn").val($("#fechaInicio").val());
      $("#fechaFinBtn").val($("#fechaFin").val());
      var fechaInicio = new Date($("#fechaInicio").val());
      var fechaFin = new Date($("#fechaFin").val());
      var top = document.getElementById('top').value;
      var hoy = new Date();
      hoy.setDate(hoy.getDate())
      if($("#fechaInicio").val() != "" && $("#fechaFin").val() != "" ){
        if(fechaInicio <= fechaFin){
          if(fechaFin <= hoy){
            if(top > 0 && top <= 20){
              esconderAlertas();
              $.ajax({
                url:"/ajaxRequestClientes_P6T",
                type:"GET",
                data: datos,
                success: function(data){
                  var datosExcel = data;
                  var fecha1 = document.getElementById('fechaInicio').value;
                  var fecha2 = document.getElementById('fechaFin').value;
                  if(data ==""){
                      bloquearBotones();
                      limpiarRedireccion();
                      alert("No hay resultados para las fechas seleccionadas");
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
                              text: value.usuario
                            })).append($("<td/>",{
                              text: value['Cantidad de compras']
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
                topMayorQueUno();
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

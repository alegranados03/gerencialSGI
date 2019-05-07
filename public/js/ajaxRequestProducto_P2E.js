
$(document).ready(function(){
    $("#btnGenerarReporte").click(function(){
      var datos = $('#form').serialize();
      $("#fechaInicioBtn").val($("#fechaInicio").val());
      $("#fechaFinBtn").val($("#fechaFin").val());
      var fechaInicio = new Date($("#fechaInicio").val());
      var fechaFin = new Date($("#fechaFin").val());
      var hoy = new Date();
      hoy.setDate(hoy.getDate()-1)
      if($("#fechaInicio").val() != "" && $("#fechaFin").val() != "" ){
        if(fechaInicio <= fechaFin){
          if(fechaFin < hoy){
            esconderAlertas();
            $.ajax({
              url:"/ajaxRequestProducto_P2E",
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
                      $("#btnExcel").attr('href','/ReporteExcel/'+JSON.stringify(datosExcel)+"/"+headers.toString()+"/"+titulo);
                      $("#btnPDF").attr('href','/ReportePDF_P2E/'+JSON.stringify(datosExcel)+"/"+fecha1+"/"+fecha2+"/Reporte de ganancia bruta por categoria.");
                      $.each(data,function(i,value){
                          var tr=$("<tr/>");
                          tr.append($("<td/>",{
                            text: value.categoria
                          })).append($("<td/>",{
                            text: value.ganancia
                          }))
                          $("#reporte-info").append(tr);
                        });
                }
              }
            });
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

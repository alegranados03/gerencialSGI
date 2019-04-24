
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
              url:"/ajaxRequestMateria_Prima_P5T",
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
                      $("#btnExcel").attr('href','/ReporteExcel/'+JSON.stringify(datosExcel));
                      $("#btnPDF").attr('href','/ReportePDF_P5T/'+JSON.stringify(datosExcel)+"/"+fecha1+"/"+fecha2+"/Reporte de costos de adquisicion de materia prima.");
                      $.each(data,function(i,value){
                          var tr=$("<tr/>");
                          tr.append($("<td/>",{
                            text: value.materia_prima
                          })).append($("<td/>",{
                            text: value.cantidad_compras
                          })).append($("<td/>",{
                            text: value.costos
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

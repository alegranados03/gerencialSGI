$(document).ready(function(){
    $("#fechaInicio").change(function(){
      $('#fechaFin').attr("disabled",false);
      $('#fechaFin').attr("min",$("#fechaInicio").val());
    });
  });

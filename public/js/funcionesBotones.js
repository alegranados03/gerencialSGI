function bloquearBotones(){
    document.getElementById('reporte').style.display = "none";
    document.getElementById('btnPDF').style.display = "none";
    document.getElementById('btnExcel').style.display = "none";
}

function desplegarBotones(){
    document.getElementById('reporte').style.display = "table";
    document.getElementById('btnPDF').style.display = "block";
    document.getElementById('btnExcel').style.display = "block";
}

function limpiarRedireccion(){
    $("#jsonExcel").val('');
    $("#keys").val('');
    $("#tituloExcel").val('');
    $("#fechaInicio2").val('');
    $("#fechaFin2").val('');
    $("#json").val('');
    $("#tituloReporte").val('');
}
function esconderAlertas(){
    $("#mensaje").hide();
    $("#mensaje2").hide();
    $("#mensaje3").hide();
    $("#mensaje4").hide();
    $("#mensaje5").hide();

}

function topMayorQueUno(){
    $("#mensaje4").attr('class','alert alert-danger alert-dismissible fade show');
    $("#mensaje4").attr('role','alert');
    $("#paragraph4").html('Error, el minimo debe ser 1');
    $("#mensaje4").show();
}

function menorQueFechaActual(){
    $("#mensaje3").attr('class','alert alert-danger alert-dismissible fade show');
    $("#mensaje3").attr('role','alert');
    $("#paragraph3").html('Error, La fecha de fin debe ser menor o igual a hoy');
    $("#mensaje3").show();
}

function fechasNoCongruentes(){
    $("#mensaje2").attr('class','alert alert-danger alert-dismissible fade show');
    $("#mensaje2").attr('role','alert');
    $("#paragraph2").html('Error, Las fechas no son congruentes');
    $("#mensaje2").show();
}

function camposFechaVacios(){
    $("#mensaje").attr('class','alert alert-danger alert-dismissible fade show');
    $("#mensaje").attr('role','alert');
    $("#paragraph").html('Error, No hay Fecha de Inicio o de Final');
    $("#mensaje").show();
}

function rangoMinimo(){
    $("#mensaje5").attr('class','alert alert-danger alert-dismissible fade show');
    $("#mensaje5").attr('role','alert');
    $("#paragraph5").html('Error, el rango mínimo entre intervalos debe ser $1.00');
    $("#mensaje5").show();
}

function intervaloMinimo(){
    $("#mensaje4").attr('class','alert alert-danger alert-dismissible fade show');
    $("#mensaje4").attr('role','alert');
    $("#paragraph4").html('Error, el mínimo de intervalos debe ser 2 intervalos y el máximo 30');
    $("#mensaje4").show();
}

function obtenerCabeceras(elemento){
    arreglo=new Array();
    for(var key in elemento){
        arreglo.push(key);
      }
      return arreglo;
}
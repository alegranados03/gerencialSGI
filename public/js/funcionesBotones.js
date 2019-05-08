function bloquearBotones(){
    document.getElementById('reporte').style.display = "none";
    document.getElementById('btnPDF').style.display = "none";
    document.getElementById('btnExcel').style.display = "none";
}

function desplegarBotones(){
    document.getElementById('reporte').style.display = "block";
    document.getElementById('btnPDF').style.display = "block";
    document.getElementById('btnExcel').style.display = "block";
}

function limpiarRedireccion(){
    $("#btnExcel").attr('href','');
    $("#btnPDF").attr('href','');
}
function esconderAlertas(){
    $("#mensaje").hide();
    $("#mensaje2").hide();
    $("#mensaje3").hide();
    $("#mensaje4").hide();

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
    $("#paragraph3").html('Error, La fecha de fin debe ser menor a hoy');
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

function obtenerCabeceras(elemento){
    arreglo=new Array();
    for(var key in elemento){
        arreglo.push(key);
      }
      return arreglo;
}
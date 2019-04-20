@extends('layouts.base')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-dark ">Bienvenido al Sistema de Informacion Gerencial de la Panaderia Lila S.A de C.V</div>
        <div class="card-body">
          <div class="row" style="color: black">
            <div class="col-md-12" style="text-align: center;">
              <h3>@include('layouts.nombreEmpresa')</h3>
              <h5>Reporte de costos de adquisicion de materia prima.</h5>
            </div>
          </div>
          <form id="form">
            <div class="row" style="text-align: right;color: black">
              <div class="col-md-2"></div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="fechaInicio">Desde:</label>
                  <input type="date" name="fechaInicio" id="fechaInicio" required>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                <div class="form-group">
                  <label for="fechaFin">Hasta:</label>
                  <input type="date" name="fechaFin" id="fechaFin" required disabled=true>
                </div>
              </div>
            </div>
          </form>
          <div class="" id="mensaje" style="width: 100%">
            <p id="paragraph"></p>
          </div>
          <div class="" id="mensaje2" style="width: 100%">
            <p id="paragraph2"></p>
          </div>
          <div class="" id="mensaje3" style="width: 100%">
            <p id="paragraph3"></p>
          </div>
          <div class="container">
            <table id="reporte" class="table table-responsive table-hovered table-striped table-condensed" width="100%" style="display: none">
              <thead id="theHeader">
                <th>Nombre Completo</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Creado</th>
              </thead>
              <tbody id="reporte-info">
                
              </tbody>
            </table>
          </div>
          <form id="form2" method="POST" action="">
            <div class="row" style="text-align: right;color: black">
              <div class="col-md-2"></div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" name="fechaInicioBtn" id="fechaInicioBtn" required>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                <div class="form-group">
                  <input type="hidden" name="fechaFinBtn" id="fechaFinBtn" required>
                </div>
              </div>
            </div>
            <div class="float-md-right">
              <div class="form-group">
                <a href="" class="btn btn-outline-success" style="color: black;">Descargar <i class="fas fa-fw fa-download"></i></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scriptDataTable')
  <script type="text/javascript">
    $(document).ready( function () {
    $('#example').DataTable({
        "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
        responsive:true,
    });
} );
  </script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#fechaInicio").change(function(){
        $('#fechaFin').attr("disabled",false);
        $('#fechaFin').attr("min",$("#fechaInicio").val());
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#fechaFin").change(function(){
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
              $("#mensaje").hide();
              $("#mensaje2").hide();
              $("#mensaje3").hide();
              $.ajax({
                url:"{{URL::to('ajaxRequestProducto_P1')}}",
                type:"GET",
                data: datos,
                success: function(data){
                  if(data ==""){
                    document.getElementById('reporte').style.display = "none";
                  }else{
                    $("#reporte-info").empty();
                        document.getElementById('reporte').style.display = "block";
                        $.each(data,function(i,value){
                          var tr=$("<tr/>");
                          tr.append($("<td/>",{
                            text: value["Nombre Completo"]
                          })).append($("<td/>",{
                            text: value.email
                          })).append($("<td/>",{
                            text: value.rol
                          })).append($("<td/>",{
                            text: value.Creado
                          }))
                          $("#reporte-info").append(tr);
                        }); 
                  }
                }
              });
              }else{
                document.getElementById('reporte').style.display = "none";
                $("#mensaje3").attr('class','alert alert-danger alert-dismissible fade show');
                $("#mensaje3").attr('role','alert');
                $("#paragraph3").html('Error, La fecha de fin debe ser menor a hoy');
                $("#mensaje3").show();
              }
            }else{
              document.getElementById('reporte').style.display = "none";
              $("#mensaje2").attr('class','alert alert-danger alert-dismissible fade show');
              $("#mensaje2").attr('role','alert');
              $("#paragraph2").html('Error, Las fechas no son congruentes');
              $("#mensaje2").show();
            }
        }else{
        document.getElementById('reporte').style.display = "none";
        $("#mensaje").attr('class','alert alert-danger alert-dismissible fade show');
        $("#mensaje").attr('role','alert');
        $("#paragraph").html('Error, No hay Fecha de Inicio');
        $("#mensaje").show();
      }
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#fechaInicio").change(function(){
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
              $("#mensaje").hide();
              $("#mensaje2").hide();
              $("#mensaje3").hide();
              $.ajax({
                url:"{{URL::to('ajaxRequestProducto_P1')}}",
                type:"GET",
                data: datos,
                success: function(data){
                  if(data ==""){
                    document.getElementById('reporte').style.display = "none";
                  }else{
                    $("#reporte-info").empty();
                        document.getElementById('reporte').style.display = "block";
                        $.each(data,function(i,value){
                          var tr=$("<tr/>");
                          tr.append($("<td/>",{
                            text: value["Nombre Completo"]
                          })).append($("<td/>",{
                            text: value.email
                          })).append($("<td/>",{
                            text: value.rol
                          })).append($("<td/>",{
                            text: value.Creado
                          }))
                          $("#reporte-info").append(tr);
                        }); 
                  }
                }
              });
              }else{
                document.getElementById('reporte').style.display = "none";
                $("#mensaje3").attr('class','alert alert-danger alert-dismissible fade show');
                $("#mensaje3").attr('role','alert');
                $("#paragraph3").html('Error, La fecha de fin debe ser menor a hoy');
                $("#mensaje3").show();
              }
            }else{
              document.getElementById('reporte').style.display = "none";
              $("#mensaje2").attr('class','alert alert-danger alert-dismissible fade show');
              $("#mensaje2").attr('role','alert');
              $("#paragraph2").html('Error, Las fechas no son congruentes');
              $("#mensaje2").show();
            }
        }else{
        document.getElementById('reporte').style.display = "none";
      }
      });
    });
  </script>
@endsection
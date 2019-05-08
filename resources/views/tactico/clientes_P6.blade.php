@extends('layouts.base')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-dark ">Bienvenido al Sistema de Informacion Gerencial de la @include('layouts.nombreEmpresa')</div>
        <div class="card-body">
          <div class="row" style="color: black">
            <div class="col-md-12" style="text-align: center;">
              <h3>@include('layouts.nombreEmpresa')</h3>
              <h5 id="titulo">Reporte de personas que mas compran en la tienda en linea.</h5>
            </div>
          </div>
          <form id="form" role="form">
            <div class="form-group row justify-content-center">
              <label for="fechaInicio" class="col-sm-0 col-form-label" style="margin-left: 5%">Desde:</label>
              <div class="col-sm-3">
                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
              </div>
              <label for="fechaFin" class="col-sm-0 col-form-label">Hasta:</label>
              <div class="col-sm-3">
                <input type="date" name="fechaFin" id="fechaFin" class="form-control" required disabled="true">
              </div>
              <label for="top" class="col-sm-0 col-form-label">TOP:</label>
              <div class="col-sm-2">
                <input type="number" min="1" step="1" name="top" id="top" class="form-control" required>
              </div>
              <div class="tooltip-demo">
                  <button title="Ranking de los mejores usuarios" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top"><i id="help" class="fa fa-question-circle"></i></button>
              </div>
              <br/>
              <br/>
              <div class="col-sm-2">
                <a id="btnGenerarReporte" class="btn btn-outline-success">Generar Reporte</a>
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
          <div class="" id="mensaje4" style="width: 100%">
            <p id="paragraph4"></p>
          </div>
          <div class="row" style="text-align: center;">
            <div class="col-lg-2 col-centered"></div>
            <div class="col-lg-9 col-centered">
              <table id="reporte" class="table table-responsive table-hovered table-striped table-condensed" width="100%" style="display: none;height: 250px;overflow:auto;">
                <thead id="theHeader">
                  <th>Nombre de usuario</th>
                  <th>Cantidad de Compras</th>
                  <th>Monto total de Compras</th>
                </thead>
                <tbody id="reporte-info">
                  
                </tbody>
              </table>
            </div>
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
                <a id="btnPDF" href="" target="_blank" class="btn btn-outline-success" style="color: black;display: none">Descargar <i class="fas fa-fw fa-download"></i></a>
              </div>
            </div>
            <div class="float-md-right">
              <div class="form-group">
                <a id="btnExcel" href="" target="_blank" class="btn btn-outline-success" style="color: black;display: none">Excel <i class="fas fa-fw fa-file-excel-o"></i></a>
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
  <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
  </script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/camposfecha.js')}}"></script> <!-- script campos de fecha-->
  <script type="text/javascript" src="{{ asset('js/funcionesBotones.js')}}"></script> <!-- script funciones generales-->
  <script type="text/javascript" src="{{ asset('js/ajaxRequestClientes_P6T.js')}}"></script> <!-- script generador de tabla-->
@endsection
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
              <h5 id="titulo">Reporte de ventas hechas en local por intervalos de monto.</h5>
            </div>
          </div>
          <form id="form" role="form">
            <div class="form-group row justify-content-center">
              <label for="fechaInicio" class="col-sm-0 col-form-label" style="margin-left: 5%">Desde:</label>
              <div class="col-sm-3">
                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
              </div>
              <label for="fechaFin" class="col-sm-0 col-form-label" style="margin-left: 5%">Hasta:</label>
              <div class="col-sm-3">
                <input type="date" name="fechaFin" id="fechaFin" class="form-control" required disabled="true">
              </div>
            </div>

            <div class="form-group row justify-content-center">
               <label for="numeroIntervalos" class="col-sm-0 col-form-label" >Numero de Intervalos:</label>
              <div class="col-sm-3">
                <input type="number" step="1" min="2" name="numeroIntervalos" id="numeroIntervalos" class="form-control" required>
              </div>
              <label for="rangoEntreIntervalos" class="col-sm-0 col-form-label">Rango entre intervalos:</label>
              <div class="col-sm-3">
                <input type="number" step="1" min="1" name="rangoEntreIntervalos" id="rangoEntreIntervalos" class="form-control" required>
              </div>
            </div>
            <div class="form-group row justify-content-center">
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
          <div class="row" style="text-align: center;">
            <div class="col-lg-4 col-centered"></div>
            <div class="col-lg-8 col-centered">
              <table id="reporte" class="table table-responsive table-hovered table-striped table-condensed" width="100%" style="display: none;height: 250px;overflow:auto;">
                <thead id="theHeader">
                  <th>Intervalo</th>
                  <th>Cantidad de ventas</th>
                  <th>Ingresos</th>
                </thead>
                <tbody id="reporte-info">
                  
                </tbody>
              </table>
            </div>
          </div>
          <form id="form2" method="POST" action="{{route('reporteP2T')}}">
            @csrf
            <div class="row" style="text-align: right;color: black">
              <div class="col-md-2"></div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" name="fechaInicio2" id="fechaInicio2" required>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                <div class="form-group">
                  <input type="text" name="fechaFin2" id="fechaFin2" required>
                </div>
              </div>
            </div>
            <div class="row" style="text-align: right;color: black">
              <div class="col-md-2"></div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" name="json" id="json" required>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                <div class="form-group">
                  <input type="text" name="tituloReporte" id="tituloReporte" required>
                </div>
              </div>
            </div>
            <div class="float-md-right">
              <div class="form-group">
                <button type="submit" formtarget="_blank" id="btnPDF" target="_blank" class="btn btn-outline-success" style="color: black;display: none">Descargar <i class="fas fa-fw fa-download"></i></a>
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
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/camposfecha.js')}}"></script> <!-- script campos de fecha-->
  <script type="text/javascript" src="{{ asset('js/funcionesBotones.js')}}"></script> <!-- script funciones generales-->
  <script type="text/javascript" src="{{ asset('js/ajaxRequestProducto_P2T.js')}}"></script> <!-- script generador de tabla-->

@endsection
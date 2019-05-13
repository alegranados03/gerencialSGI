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
              <h5 id="titulo">Reporte de Ingresos por venta por producto.</h5>
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
          <div class="row justify-content-center" style="text-align: center;">
            <div class="col-lg-10 col-centered">
              <table class="table-responsive">
                <table id="reporte" class="table table-responsive table-hover table-striped table-condensed" width="100%" style="display: none;height: 250px;overflow:auto;">
                  <thead id="theHeader" class="thead-dark">
                    <th>Nombre del Producto</th>
                    <th>Cantidad Vendida</th>
                    <th>Ingresos</th>
                  </thead>
                  <tbody id="reporte-info">
                    
                  </tbody>
                </table>
              </table>
            </div>
          </div>
          <div class="float-md-right">
            <table class="table table-responsive">
              <tr>
                <td class="border-0">
                  <form id="form2" method="POST" action="{{route('reporteP1T')}}">
                    @csrf
                    <div class="row" style="text-align: right;color: black">
                      <div class="col-md-2"></div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="hidden" name="fechaInicio2" id="fechaInicio2" required>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                        <div class="form-group">
                          <input type="hidden" name="fechaFin2" id="fechaFin2" required>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="text-align: right;color: black">
                      <div class="col-md-2"></div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="hidden" name="json" id="json" required>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                        <div class="form-group">
                          <input type="hidden" name="tituloReporte" id="tituloReporte" required>
                        </div>
                      </div>
                    </div>
                    <div class="float-md-right">
                      <div class="form-group">
                        <button type="submit" formtarget="_blank" id="btnPDF" target="_blank" class="btn btn-outline-success" style="color: black;display: none">Descargar <i class="fas fa-fw fa-download"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </td>
                <td class="border-0">
                  <form id="form3" method="POST" action="{{route('excel')}}">
                    @csrf
                    <div class="row" style="text-align: right;color: black">
                      <div class="col-md-2"></div>
                      <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                        <div class="form-group">
                          <input type="hidden" name="keys" id="keys" required>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="text-align: right;color: black">
                      <div class="col-md-2"></div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="hidden" name="jsonExcel" id="jsonExcel" required>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12 ml-0" style="margin-left:5%">
                        <div class="form-group">
                          <input type="hidden" name="tituloExcel" id="tituloExcel" required>
                        </div>
                      </div>
                    </div>
                    <div class="float-md-right">
                      <div class="form-group">
                        <button type="submit" formtarget="_blank" id="btnExcel" target="_blank" class="btn btn-outline-success" style="color: black;display: none">Excel <i class="fas fa-fw fa-file-excel-o"></i>
                        </button>
                      </div>
                    </div>
                  </form>  
                </td>
              </tr>
            </table>
          </div>
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
  <script type="text/javascript" src="{{ asset('js/ajaxRequestProducto_P1T.js')}}"></script> <!-- script generador de tabla-->

@endsection
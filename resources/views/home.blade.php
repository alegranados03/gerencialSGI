@extends('layouts.base')

@section('content')
          <div class="row">
            <div class="col-md-12">
              <div class="card">
              <div class="card-body">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
                @if (\Session::has('danger'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('danger') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="card-header text-white bg-primary border border-primary">Bienvenido al Sistema de Información Gerencial de la Panadería Lila S.A de C.V</div>
                <div class="card-body border border-primary">
                    <div class="row" style="text-align: center; color: black;">
                        <div class="col-md-12 col-sm-12">
                            <h3>¿Que desea saber hoy?</h3>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <h5>El sistema de información gerencial es un apoyo a la toma de sus decisiones, elija la opción de la cual quiere obtener información de su empresa.</h5>
                        </div>
                        @can('home.estrategico')
                            <div class="col-md-12" style="color: white;">.</div>
                            <div class="col-md-12" style="color: white;">.</div>
                            <div class="col-md-12" style="color: white;">.</div>
                            <div class="col-md-12" style="color: white;">.</div>                            
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('estrategico.producto_P1')}}" style="color: black;"><i class="fas fa-fw fa-list-ol" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('estrategico.producto_P1')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de ingresos
                                        </p>
                                        <p style="margin-top: -5%">
                                            por venta por categoría
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('estrategico.producto_P2')}}" style="color: black;"><i class="fas fa-fw fa-list-ol" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('estrategico.producto_P2')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de ganancia
                                        </p>
                                        <p style="margin-top: -5%">
                                            bruta por categoría
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('estrategico.materia_prima_P3')}}" style="color: black;"><i class="fas fa-fw fa-store" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('estrategico.materia_prima_P3')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de Costos de
                                        </p>
                                        <p style="margin-top: -5%">
                                            materia prima por
                                        </p>
                                        <p style="margin-top: -5%">
                                            proveedor.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('estrategico.clientes_P4')}}" style="color: black;"><i class="fas fa-fw fa-money-check-alt" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('estrategico.clientes_P4')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de preferencia
                                        </p>
                                        <p style="margin-top: -5%">
                                            de pago de los clientes
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('estrategico.clientes_P5')}}" style="color: black;"><i class="fas fa-fw fa-store-alt" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('estrategico.clientes_P5')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de ventas
                                        </p>
                                        <p style="margin-top: -5%">
                                            realizadas en la tienda
                                        </p>
                                        <p style="margin-top: -5%">
                                            en linea agrupados
                                        </p>
                                        <p style="margin-top: -5%">
                                            por género
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endcan
                        @can('home.tactico')
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('tactico.producto_P1')}}" style="color: black;"><i class="fas fa-fw fa-money-check-alt" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('tactico.producto_P1')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de ingresos por
                                        </p>
                                        <p style="margin-top: -5%">
                                            venta por producto.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('tactico.producto_P2')}}" style="color: black;"><i class="fas fa-fw fa-store-alt" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('tactico.producto_P2')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de ventas hechas
                                        </p>
                                        <p style="margin-top: -5%">
                                            en local por intervalos de
                                        </p>
                                        <p style="margin-top: -5%">
                                            monto.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('tactico.producto_P3')}}" style="color: black;"><i class="fas fa-fw fa-store-alt" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('tactico.producto_P3')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de ventas hechas
                                        </p>
                                        <p style="margin-top: -5%">
                                            en linea por intervalos de
                                        </p>
                                        <p style="margin-top: -5%">
                                            monto.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('tactico.producto_P4')}}" style="color: black;"><i class="fas fa-fw fa-list-ol" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('tactico.producto_P4')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de ingresos de 
                                        </p>
                                        <p style="margin-top: -5%">
                                            venta por intervalos de
                                        </p>
                                        <p style="margin-top: -5%">
                                            horas.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('tactico.materia_prima_P5')}}" style="color: black;"><i class="fas fa-fw fa-store" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('tactico.materia_prima_P5')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de costos de 
                                        </p>
                                        <p style="margin-top: -5%">
                                            adquisición de materia
                                        </p>
                                        <p style="margin-top: -5%">
                                            prima.
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <a class="nav-item" href="{{route('tactico.clientes_P6')}}" style="color: black;"><i class="fas fa-fw fa-group" style="font-size:60px"></i><i class="fas fa-fw fa-file-text" style="font-size:20px"></i></a>
                                <br/>
                                <a class="nav-item" href="{{route('tactico.clientes_P6')}}" style="color: black;">
                                    <div style="text-align: justify; margin-left: 28%">
                                        <p>
                                            Reporte de personas que
                                        </p>
                                        <p style="margin-top: -5%">
                                            compran más en la tienda
                                        </p>
                                        <p style="margin-top: -5%">
                                            en línea.
                                        </p>
                                    </div>
                                </a>
                            </div>
                    @endcan
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
@endsection
@extends('layouts.base')

@section('usuario')
- Listado de Usuarios
@endsection


@section('content')
<!--<div class="container">-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12" style="color: black">
                            Bienvenido al Sistema de Informacion Gerencial de la @include('layouts.nombreEmpresa')
                        </div>
                    </div>
                </div>
                <div class="card-body">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                @if (\Session::has('danger'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('danger') !!}</li>
                        </ul>
                    </div>
                @endif
                    <div class="pull-right">
                        <a href="{{route('usuario.create')}}" class="btn btn-success" style="color: black; width: 100%"><i class="fa fa-fw fa-user-plus"></i> Registrar Usuario</a>
                    </div>
                    <br/>
                    <br/>
                    <div class="pull-bottom">
                        <div class="table table-responsive">
                            <table id="example" class="display table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="all">Nombre</th>
                                        <th class="all">Email</th>
                                        <th class="all">Rol</th>
                                        <th class="all">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $user)
                                        <tr>
                                            <td width="50%">{{$user->nombre_usuario}}</td>
                                            <td >{{$user->email}}</td>
                                            <td >{{$user->nombre_rol}}</td>
                                            <td width="34%">
                                                <a href="{{route('usuario.edit',['user' => $user->id])}}" class="btn btn-success btn-xs" style="color: black;">Editar</a>
                                                <a href="{{route('usuario.bitacora',['idUsuario' => $user->id])}}" class="btn btn-primary" style="color: black;">Actividad</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
@endsection

@section('scriptDataTable')
  <script type="text/javascript">
    $(document).ready( function () {
        $('#example').DataTable({
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
            responsive:true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, 
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, 
            'colvis'
            ]
        });


});
  </script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script src="{{asset('js/buttons.colVis.min.js')}}"></script>


@endsection
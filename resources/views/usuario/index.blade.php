@extends('layouts.base')

@section('content')
<!--<div class="container">-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12" style="color: black">
                            Bienvenido al Sistema de Informacion Gerencial de la Panaderia Lila S.A de C.V
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
                                        <th id="relevante" class="all">Nombre</th>
                                        <th id="relevante" class="all">Email</th>
                                        <th id="relevante" class="all">Rol</th>
                                        <th class="all">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $user)
                                        <tr>
                                            <td width="23%">{{$user->nombre_usuario}}</td>
                                            <td >{{$user->email}}</td>
                                            <td >{{$user->nombre_rol}}</td>
                                            <td width="34%">
                                                <a href="{{route('usuario.edit',['user' => $user->id])}}" class="btn btn-success btn-xs" style="color: black;">Editar</a>
                                                <a class="btn btn-warning btn-xs" style="color: black">Revocar Permisos</a>
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
        $('#example thead th#relevante').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
        } );

        var table=$('#example').DataTable({
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
            responsive:true,
        });
        // Apply the search
        table.columns().every( function () {
            var that = this;
     
            $( 'input', this.header() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

});
  </script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
@endsection
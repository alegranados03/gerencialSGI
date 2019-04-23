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
                <div class="table table-responsive">
                            <table id="example" class="display table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th id="relevante" class="all">Nombre</th>
                                        <th id="relevante" class="all">Historia</th>
                                        <th id="relevante" class="all">Fecha Creacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($actividades as $actividad)
                                        <tr>
                                            <td >{{$actividad->nombre_completo}}</td>
                                            <td >{{$actividad->comentario_de_actividad}}</td>
                                            <td >{{$actividad->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
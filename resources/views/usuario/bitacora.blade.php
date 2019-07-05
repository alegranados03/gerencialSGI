@extends('layouts.base')

@section('content')
<!--<div class="container">-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12" style="color: black">
                        Bienvenido al Sistema de Información Gerencial de la @include('layouts.nombreEmpresa')   
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <div class="container" align="center">
                        <div class="float-md-center" style="width: 100%">
                            <h2>Filtro de Actividad</h2>
                            <div class="row">
                                <div class="col-sm-1 col-form-label">
                                    <label> Desde:</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" id="min" name="min" class="form-control">
                                </div>
                                <div style="margin-left: 10%"></div>
                                <div class="col-sm-1 col-form-label">
                                    <label> Hasta:</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" id="max" name="max" class="form-control">
                                </div>
                            </div>
                    </div>
                    </div>
                    <br/>
                    <br/>
                    <table id="example" class="display table table-striped table-hovered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="all">Nombre</th>
                                <th class="all">Historia</th>
                                <th class="all">Fecha Creacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actividades as $actividad)
                                <tr>
                                    <td >{{$actividad->nombre_completo}}</td>
                                    <td >{{$actividad->comentario_de_actividad}}</td>
                                    <td >
                                        @php
                                            $date=date_create($actividad->created_at);
                                            $aux= date_format($date,"d/m/Y H:i:s");
                                        @endphp
                                        {{$aux}}
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
<!--</div>-->
@endsection

@section('scriptDataTable')
  <script type="text/javascript">
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
        var min = new Date( $('#min').val());
        min = new Date(min.getFullYear(),min.getMonth(),min.getDate()+1,0,0,0);
        var max = new Date( $('#max').val());
        max = new Date(max.getFullYear(),max.getMonth(),max.getDate()+1,23,59,59);
        var age = new Date( data[2].substring(6,10), parseInt(data[2].substring(3,5))-1,data[2].substring(0,2)); // use data for the age column
        if ( ( isNaN( min.getTime() ) && isNaN( max.getTime() ) ) ||( isNaN( min.getTime() ) && age <= max ) ||( min <= age   && isNaN( max.getTime() ) ) || ( min <= age   && age <= max ) ){
        
                return true;
            }
            return false;
        }
    );
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
            dom: 'Bfrtip',
            buttons: ['pdf']
        });
        // Event listener to the two range filtering inputs to redraw on input
        $('#min').change( function() {
            table.draw();
        } );
        $('#max').change( function() {
            table.search('');
            table.draw();
        } );
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
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
@endsection
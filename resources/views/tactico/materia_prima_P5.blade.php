@extends('layouts.base')

@section('content')
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header text-dark ">Bienvenido al Sistema de Informacion Gerencial de la Panaderia Lila S.A de C.V</div>
                <div class="card-body">
                    Materia_Prima_P5
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
@extends('layouts.base')

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
            <div class="card-body" style="width: 100%"> 
                       
            <div>
            <select class='form-control' id='respaldo' name='respaldo' required>
            <option value="">Seleccionar Respaldo</option>
                        @foreach($respaldos as $r)
                          <option value="{{$r}}">{{$r}}</option>
                        @endforeach
            </select>

            <div class="float-md-right">
            <a href="#" onclick="confirmar()" data-toggle="modal" 
            data-target="#confirmacionModal" class="btn btn-outline-primary">Realizar la restauración</a>
              </div>

            </div>
            </div>     
          </div>
  </div>

  <!-- Modal-->
  <div class="modal fade" id="confirmacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Estás seguro de esto?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">¿Está seguro que desea realizar la restauración de la base de datos? Esta acción no se puede deshacer.
        <form action="{{route('ejecutar_restauracion')}}" method="POST"> 
        @csrf
        <input type="hidden" name="respaldoModal" id="respaldoModal">
        </div>
        <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-outline-primary" value="Confirmar Restauración">
        </form>  
        </div>
      </div>
    </div>
  </div>
<!--</div>-->

<script type='text/javascript'>
function confirmar(){
$("#respaldoModal").val($("#respaldo").val());
}
</script>
@endsection
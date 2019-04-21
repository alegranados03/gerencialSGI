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
            <div class="card-body" style="width: 100%">
                <form method="POST" action="{{route('usuario.store')}}">
                  @csrf
                  <div class="row" style="text-align: center">
                    <div class="col-md-4">
                      <label style="align-content: center;">Primer Nombre:</label>
                      <input id="primer_nombre" name="primer_nombre"  type="text" class="form-control" placeholder="Primer Nombre">
                    </div>
                    <div class="col-md-4">
                    <label style="align-content: center;">Segundo Nombre:</label>
                      <input id="segundo_nombre" name="segundo_nombre" type="text" class="form-control" placeholder="Segundo Nombre">
                    </div>
                    <div class="col-md-4">
                    <label style="align-content: center;">Primer Apellido:</label>
                      <input id="primer_apellido" name="primer_apellido" type="text" class="form-control" placeholder="Primer Apellido">
                    </div>
                  </div>

                  <div class="row" style="text-align: center;">
                    <div class="col-md-4">
                    <label style="align-content: center;">Segundo Apellido:</label>
                      <input id="segundo_apellido" name="segundo_apellido" type="text" class="form-control" placeholder="Segundo Apellido">
                    </div>
                    <div class="col-md-4">
                    <label style="align-content: center;">E-Mail:</label>
                      <input id="email" name="email" type="email" class="form-control" placeholder="E-Mail">
                    </div>
                  </div>
                  <div class="container" style="margin-top: 1%">
                      <div class="row" style="text-align: center;">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                        </div>
                        <div class="col-md-3" style="text-align: left;">
                            <button type="reset" class="btn btn-outline-info">Limpiar Pantalla</button>
                        </div>
                        <div class="col-md-3"></div>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
@endsection
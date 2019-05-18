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
                <form method="POST" action="{{route('usuario.store')}}">
                  @csrf
                  <div class="row" style="text-align: center">
                    <div class="col-md-4 form-group{{ $errors->has('primer_nombre') ? ' has-error' : '' }}">
                      <label style="align-content: center;">Primer Nombre:</label>
                      <input id="primer_nombre" name="primer_nombre"  type="text" class="form-control" value="{{ old('primer_nombre') }}" placeholder="Primer Nombre" required>
                      @if ($errors->has('primer_nombre'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('primer_nombre') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-md-4 form-group{{ $errors->has('segundo_nombre') ? ' has-error' : '' }}">
                    <label style="align-content: center;">Segundo Nombre:</label>
                      <input id="segundo_nombre" name="segundo_nombre" type="text" class="form-control" value="{{ old('segundo_nombre') }}" placeholder="Segundo Nombre" required>
                      @if ($errors->has('segundo_nombre'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('segundo_nombre') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-md-4 form-group{{ $errors->has('primer_apellido') ? ' has-error' : '' }}">
                    <label style="align-content: center;">Primer Apellido:</label>
                      <input id="primer_apellido" name="primer_apellido" type="text" class="form-control" value="{{ old('primer_apellido') }}" placeholder="Primer Apellido" required>
                      @if ($errors->has('primer_apellido'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('primer_apellido') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>

                  <div class="row" style="text-align: center;">
                    <div class="col-md-4 form-group{{ $errors->has('segundo_apellido') ? ' has-error' : '' }}">
                    <label style="align-content: center;">Segundo Apellido:</label>
                      <input id="segundo_apellido" name="segundo_apellido" type="text" class="form-control" value="{{ old('segundo_apellido') }}" placeholder="Segundo Apellido" required>
                      @if ($errors->has('segundo_apellido'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('segundo_apellido') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label style="align-content: center;">E-Mail:</label>
                      <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="E-Mail" required>
                      @if ($errors->has('email'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-md-4">
                      <label style="align-content: center;">Rol:</label>
                      <select class="form-control" id="role" name="role" required>
                          <option value="">Seleccionar Rol</option>
                        @foreach($roles as $rol)
                          <option value="{{$rol->id}}">{{$rol->name}}</option>
                        @endforeach
                      </select>
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
@extends('layouts.base')

@section('content')
<!--<div class="container">-->
<div class="row">
    <div class="col-md-12">
    @if (\Session::has('danger'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('danger') !!}</li>
                        </ul>
                    </div>
                @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12" style="color: black">
                        Bienvenido al Sistema de Informacion Gerencial de la @include('layouts.nombreEmpresa')    
                    </div>
                </div>
                
            </div>
            <div class="card-body" style="width: 100%">
                <form method="POST" action="{{route('actualizarPassword')}}">
                  @csrf
                  <div class="row" style="text-align: center">
                    <div class="col-md-4 form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                      <label style="align-content: center;">Contraseña Actual:</label>
                      <input id="old_password" name="old_password"  type="password" class="form-control"  placeholder="Contraseña Actual">
                      @if ($errors->has('old_password'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <div class="col-md-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label style="align-content: center;">Nueva Contraseña:</label>
                      <input id="password" name="password"  type="password" class="form-control" placeholder="Nueva Contraseña">
                      @if ($errors->has('password'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <div class="col-md-4 form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                      <label style="align-content: center;">Confirmar Nueva Contraseña:</label>
                      <input id="password_confirm" name="password_confirm"  type="password" class="form-control" placeholder="Confirmar Nueva Contraseña">
                      @if ($errors->has('password_confirm'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('password_confirm') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>
                  <div class="container" style="margin-top: 1%">
                      <div class="row" style="text-align: center;">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-outline-success">Cambiar Contraseña</button>
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
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
                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Respaldo de Base de datos Gerencial.
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                      <p ALIGN="justify">
                      Este apartado de la aplicación sirve para ejecutar la orden de creación un archivo de respaldo de la base de datos sobre la cual opera este sistema de información gerencial.
                      Al presionar el botón "Realizar respaldo de base de datos gerencial" se guardarán todos los datos dentro de la base y su estructura en un archivo de extensión .sql 
                      dentro de la ruta raíz, en la carpeta storage\backups, el archivo tendrá el formato de nombre
                      "backup_panaderia__xxx mmddyyy_hh-min-s", siendo 'mm' el mes, 'dd' el día, 'yyyy' el año,
                      'hh' la hora en formato 24 horas, 'min' los minutos y 's' los segundos del momento en que el archivo fue creado.
                      Al mismo tiempo en la misma ubicación se creará un archivo llamado "last_backup.sql" 
                      que será una copia del último respaldo realizado, 
                      este archivo servirá para el proceso de restauración en caso de fallos en la base de datos.
                      El respaldo se realiza cada día domingo a las 00:00 am de forma automática, 
                      pero tiene la opción de realizar 3 respaldos adicionales cada semana. Si el botón no aparece es posible que ya se hayan realizado los 3 respaldos disponibles en la semana.
                      Siempre verifique que el archivo ha sido creado correctamente.
                       </p>
                       </br>
                        <div class="float-md-right">
                          <a href="{{route('ejecutar_avanzada',['accion' =>'Backup'])}}" class="btn btn-outline-primary">Realizar respaldo de base de datos gerencial</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Proceso de Extracción, Transformación y Carga.
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                      <p ALIGN="justify">
                      Este apartado de la aplicación sirve para ejecutar el script de extracción, transformación y carga 
                      de datos de la base de datos del sistema transaccional a la base de datos gerencial.
                      Al presionar el botón "Ejecutar proceso de ETL" se ejecutará el script que extraerá
                      todos los datos necesarios para generar reportes, desde la base de datos transaccional y 
                      los cargará dentro de la base gerencial.
                      El proceso de ETL se realiza cada día por la madrugada a las 01:00 am de forma automática, 
                      pero tiene la opción de ejecutar el proceso de ETL una vez al día. 
                      Si el botón no aparece es posible que ya se haya hecho uso de esta función en este día.
                       </p>
                       </br>                        
                       <div class="float-md-right">
                          <a href="{{route('ejecutar_avanzada',['accion' =>'ETL'])}}" class="btn btn-outline-primary">Ejecutar proceso de ETL</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Restauración de base de datos.
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body">
                      <p ALIGN="justify">
                      Este apartado de la aplicación sirve para ejecutar una restauración de la base de datos gerencial.
                      Al presionar el botón "Realizar una restauración de base de datos" 
                      se cargarán los datos del último respaldo de base de datos realizado.
                      Utilicelo solo en caso de defectos en la base de datos o en otro tipo de errores como fallos del proceso de ETL.
                      Solicite autorización del super administrador de la aplicación.
                      </p>
                      </br>
                      <div class="float-md-right">
                          <a href="#"  data-toggle="modal" data-target="#autorizacionModal" class="btn btn-outline-primary">Realizar una restauración de base de datos</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal-->
  <div class="modal fade" id="autorizacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Necesitas autorización</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Para acceder a esta sección necesitas confirmar la presencia y autorización de un usuario de nivel estratégico
        a continuación el usuario de nivel estratégico debe ingresar sus credenciales para confirmar que autoriza esta acción.</div>

        <form action="{{route('vista_restauracion')}}" method="POST">
                      @csrf
                      <label for="username">Usuario Estratégico</label>
                        <input type="text" id=username name="username" class="form-control" required autocomplete=off><br><br>
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" required autocomplete=off><br><br>
                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-outline-primary" value="Confirmar Autorización">
                      </form>

        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<!--</div>-->
@endsection
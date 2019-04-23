<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Panaderia Lila</title>

  <!-- Custom fonts for this template -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
  .sidebar-brand{
    background-color: #212529;
  }
  .navbar{
    background-color: #212529;
  }
  .sidebar-divider{
    background-color: white;
    width: 100%;
  }
  @media screen and (max-width: 767px) {
    li.paginate_button.previous {
        display: inline;
    }
 
    li.paginate_button.next {
        display: inline;
    }
 
    li.paginate_button {
        display: none;
    }
  }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <img src="{{asset('css/Free_Sample2_By_Wix.png')}}" style="height: 300%">
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel ') }}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      @if(!Auth::user()->isAdmin())
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-home"></i>
            <span>Inicio</span></a>
        </li>
        @can('home.tactico')
          <!-- Divider -->
          <hr class="sidebar-divider">
          <!-- Heading -->
          <div class="sidebar-heading">
            Reportes Tacticos
          </div>

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-book"></i>
              <span>Reportes Tacticos</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Reportes Tacticos:</h6>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Productos</h6>
                <div class="collapse-divider"></div>
                  <a class="collapse-item" href="{{route('tactico.producto_P1')}}">
                    <i class="fa fa-file-text">
                        Reporte de ingresos por
                      <p>
                        venta por producto.
                      </p>
                    </i>
                  </a>
                  <a class="collapse-item" href="{{route('tactico.producto_P2')}}">
                    <i class="fa fa-file-text">
                      Reporte de ventas hechas
                      <p>
                        en local por intervalos
                      </p>
                      <p style="margin-top: -10%">
                        de monto.
                      </p>
                    </i>
                  </a>
                  <a class="collapse-item" href="{{route('tactico.producto_P3')}}">
                    <i class="fa fa-file-text">
                      Reporte de ventas hechas
                      <p>
                        en linea por intervalos
                      </p>
                      <p style="margin-top: -10%">
                        de monto.
                      </p>
                    </i>
                  </a>
                  <a class="collapse-item" href="{{route('tactico.producto_P4')}}">
                    <i class="fa fa-file-text">
                      Reporte de ingresos de
                      <p>
                        venta por intervalos
                      </p>
                      <p style="margin-top: -10%">
                        de horas.
                      </p>
                    </i>
                  </a>
                <h6 class="collapse-header">Materia Prima</h6>
                <div class="collapse-divider"></div>
                  <a class="collapse-item" href="{{route('tactico.materia_prima_P5')}}">
                    <i class="fa fa-file-text">
                        Reporte de costos de  
                        <p>
                          adquisicion de materia
                        </p>
                        <p style="margin-top: -10%">
                          prima.
                        </p>
                    </i>
                  </a>
                <h6 class="collapse-header">Clientes</h6>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="{{route('tactico.clientes_P6')}}">
                  <i class="fa fa-file-text">
                    Reporte de personas que
                    <p>
                      mas compran en la tienda
                    </p>
                    <p style="margin-top: -10%">
                      en linea.
                    </p>
                  </i>
                </a>
              </div>
            </div>
          </li>
        @endcan

        @can('home.estrategico')
          <!-- Divider -->
          <hr class="sidebar-divider">
        
          <!-- Heading -->
          <div class="sidebar-heading">
            Reportes Estrategicos
          </div>

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-folder"></i>
              <span>Reportes Estrategicos</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Reportes Estrategicos:</h6>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Categorias de Producto</h6>
                <div class="collapse-divider"></div>
                  <a class="collapse-item" href="{{route('estrategico.producto_P1')}}">
                    <i class="fa fa-file-text">
                        Reporte de ingresos
                      <p>
                        por venta por categoria.
                      </p>
                    </i>
                  </a>
                  <a class="collapse-item" href="{{route('estrategico.producto_P2')}}">
                    <i class="fa fa-file-text">
                      Reporte de ganancia
                      <p>
                        bruta por categoria.
                      </p>
                    </i>
                  </a>
                <h6 class="collapse-header">Materia Prima</h6>
                <div class="collapse-divider"></div>
                  <a class="collapse-item" href="{{route('estrategico.materia_prima_P3')}}">
                    <i class="fa fa-file-text">
                        Reporte de Costos de
                      <p>
                        materia prima por
                      </p>
                      <p style="margin-top: -10%">
                        proveedor.
                      </p>
                    </i>
                  </a>
                <h6 class="collapse-header">Clientes</h6>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="{{route('estrategico.clientes_P4')}}">
                    <i class="fa fa-file-text">
                        Reporte de preferencia 
                      <p>
                        de pago de los clientes.
                      </p>
                    </i>
                  </a>
                  <a class="collapse-item" href="{{route('estrategico.clientes_P5')}}">
                    <i class="fa fa-file-text">
                        Reporte de ventas
                        <p>
                          realizadas en la tienda
                        </p>
                        <p style="margin-top: -10%">
                            en linea agrupados
                        </p>
                        <p style="margin-top: -10%">
                            por genero
                        </p>
                    </i>
                  </a>
              </div>
            </div>
          </li>
        @endcan
      @endif
      @if(!Auth::user()->isEstrategico() && !Auth::user()->isTactico())
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Usuarios</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Acciones:</h6>
              <a class="collapse-item" href="/home"><i class="fa fa-group"> Lista de Usuarios</i></a>
            </div>
          </div>
        </li>
      @endif
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">            
            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                @guest
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> 
                @endguest
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> 
                @guest
                    
                @else
                    {{Auth::user()->primer_nombre}} {{Auth::user()->segundo_nombre}} {{Auth::user()->primer_apellido}} {{Auth::user()->segundo_apellido}}
                @endguest
                </span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('editarPassword')}}">
                  <i class="fas fa-fw fa-lock fa-sm mr-2 text-gray-400 "></i>
                  Cambiar Contraseña
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesion
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Estas Listo para irte?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona la opcion de "Cerrar Sesion" si estas listo para finalizar tu actual sesion.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <!-- Page level custom scripts -->
  @yield('scriptDataTable')
</body>

</html>

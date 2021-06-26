<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <head lang="es">
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
        <meta content="ie=edge" http-equiv="x-ua-compatible">
        <title>
            @yield('titulo', "inicio")
        </title>

        {{-- token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{asset('app/publico/css/lib/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('bootstrap5/css/bootstrap.min.css')}}" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <link rel="stylesheet" href="{{asset('app/publico/css/lib/lobipanel/lobipanel.min.css')}}">
        <link rel="stylesheet" href="{{asset('app/publico/css/separate/vendor/lobipanel.min.css')}}">
        <link rel="stylesheet" href="{{asset('app/publico/css/lib/jqueryui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('app/publico/css/separate/pages/widgets.min.css')}}">

        {{-- font awesome --}}
        <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('fontawesome/css/fontawesome.min.css')}}">

        {{-- datatables --}}
        <link rel="stylesheet" href="{{asset('app/publico/css/lib/datatables-net/datatables.min.css')}}">
        <link rel="stylesheet" href="{{asset('app/publico/css/separate/vendor/datatables-net.min.css')}}">

        <link href="{{asset('app/publico/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('app/publico/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('app/publico/css/mis_estilos/estilos.css')}}" rel="stylesheet">

        {{-- form --}}
        <link rel="stylesheet" type="text/css"
            href="{{asset('app/publico/css/lib/jquery-flex-label/jquery.flex.label.css')}}"> <!-- Original -->

        {{-- mis estilos --}}
        <link href="{{asset('principal/css/estilos.css')}}" rel="stylesheet">

        {{-- pNotify --}}
        <link href="{{asset('pnotify/css/pnotify.css')}}" rel="stylesheet" />
        <link href="{{asset('pnotify/css/pnotify.buttons.css')}}" rel="stylesheet" />
        <link href="{{asset('pnotify/css/custom.min.css')}}" rel="stylesheet" />

        {{-- google fonts --}}
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

        {{-- pnotify --}}
        <script src="{{asset('pnotify/js/jquery.min.js')}}">
        </script>
        <script src="{{asset('pnotify/js/pnotify.js')}}">
        </script>
        <script src="{{asset('pnotify/js/pnotify.buttons.js')}}">
        </script>



        @laravelPWA

    </head>
</head>

<body class="with-side-menu">
    <div id="app">

        <header class="site-header">
            <div class="container-fluid" style="padding-left: 40px;">

                <a href="#" class="site-logo">

                </a>

                <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
                    <span>toggle menu</span>
                </button>

                <button class="hamburger hamburger--htla">
                    <span>toggle menu</span>
                </button>
                <div class="site-header-content">
                    <div class="site-header-content-in">
                        <div class="site-header-shown">

                            <div class="dropdown dropdown-notification">
                                <h6 class="text-light mt-2">
                                    {{Auth::user()->nombres}}
                                </h6>
                            </div>

                            <div class="dropdown user-menu">
                                <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    @if (Auth::user()->foto==null)
                                    <img src="{{asset('app/publico/img/user.svg')}}" alt="">
                                    @else
                                    <img src="data:image/jpg;base64,<?= base64_encode(Auth::user()->foto) ?>" alt="">
                                    @endif
                                </button>
                                <div class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="dd-user-menu">

                                    <h5 class="p-2 text-center bg-primary">{{Auth::user()->nombres}}</h5>
                                    <a class="dropdown-item" href="{{route("perfil.index")}}"><span
                                            class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
                                    <a class="dropdown-item" href="{{route("clave.index")}}"><span
                                            class="font-icon glyphicon glyphicon-lock"></span>Cambiar contraseña</a>

                                    <div class="dropdown-divider"></div>


                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><span
                                            class="font-icon glyphicon glyphicon-log-out"></span>Salir</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--.site-header-shown-->

                        <div class="mobile-menu-right-overlay"></div>
                        <div class="site-header-collapsed">

                        </div>
                        <!--.site-header-collapsed-->
                    </div>
                    <!--site-header-content-in-->
                </div>
                <!--.site-header-content-->
            </div>
            <!--.container-fluid-->
        </header>

        <div class="mobile-menu-left-overlay">
        </div>
        <nav class="side-menu">
            <div class="m-auto text-center p-1">
                @if (Auth::user()->foto==null)
                <img style="width: 70px;height: 70px;border-radius: 50%;" class="img-thumbnail"
                    src="{{asset('app/publico/img/user.svg')}}" alt="">
                @else
                <img style="width: 70px;height: 70px;border-radius: 50%;" class="img-thumbnail"
                    src="data:image/jpg;base64,<?= base64_encode(Auth::user()->foto) ?>" alt="">
                @endif
                <h6 class="text-success font-weight-bold pt-2">
                    @if (Auth::user()->tipo === 1)
                    ADMINISTRADOR
                    @else
                    USUARIO
                    @endif
                </h6>
            </div>
            <ul class="side-menu-list p-0">
                {{-- <li class="red">
                    <a href="{{route('home')}}" class="{{ Request::is('home*') ? 'activo' : ''}}">
                        <i class="fas fa-house-user"></i>
                        <span class="lbl">INICIO</span>
                    </a>
                </li> --}}
                <li class="red">
                    <a href="{{route('usuario.index')}}" class="{{ Request::is('usuario*','home*') ? 'activo' : ''}}">
                        <i class="fas fa-house-user"></i>
                        <span class="lbl">USUARIOS</span>
                    </a>
                </li>
                <li class="red">
                    <a href="{{route('tipo.index')}}" class="{{ Request::is('tipo-usuario*') ? 'activo' : ''}}">
                        <i class="fas fa-house-user"></i>
                        <span class="lbl">TIPO USUARIO</span>
                    </a>
                </li>
                <li class="red">
                    <a href="{{route('pais.index')}}" class="{{ Request::is('pais*') ? 'activo' : ''}}">
                        <i class="fas fa-house-user"></i>
                        <span class="lbl">PAISES</span>
                    </a>
                </li>
                <li class="red">
                    <a href="{{route('diplomacias.index')}}" class="{{ Request::is('diplomacias*') ? 'activo' : ''}}">
                        <i class="fas fa-house-user"></i>
                        <span class="lbl">DIPLOMATICAS (acuerdos)</span>
                    </a>
                </li>
                <li class="red">
                    <a href="{{route('producto.index')}}" class="{{ Request::is('producto*') ? 'activo' : ''}}">
                        <i class="fas fa-house-user"></i>
                        <span class="lbl">PRODUCTOS</span>
                    </a>
                </li>
                <li class="red">
                    <a href="{{route('exportar.index')}}" class="{{ Request::is('exportaciones*') ? 'activo' : ''}}">
                        <i class="fas fa-house-user"></i>
                        <span class="lbl">EXPORTACIONES</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="page-content mt-5">
            @yield('content')
        </div>
    </div>


    <script src="{{asset('bootstrap5/js/popper.min.js')}}"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>


    <script src="{{asset('app/publico/js/lib/jquery/jquery.min.js')}}">
    </script>
    <script src="{{asset('app/publico/js/lib/tether/tether.min.js')}}">
    </script>
    <script src="{{asset('app/publico/js/lib/bootstrap/bootstrap.min.js')}}">
    </script>
    <script src="{{asset('app/publico/js/plugins.js')}}">
    </script>

    {{-- datatables --}}
    <script src="{{asset('app/publico/js/lib/datatables-net/datatables.min.js')}}"></script>



    {{-- sweet alert --}}
    <script src="{{asset('sweet/js/sweetalert2.js')}}"></script>
    <script src="{{asset('sweet/js/sweet.js')}}"></script>


    <script>
        $(function() {
			$('#example').DataTable({
				select: {
					//style: 'multi'
				},
                responsive: true,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                "sInfo":           "Registros del _START_ al _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Registros del 0 al 0 de 0 registros",
                "sInfoFiltered":   "-",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
			});
		});
    </script>


    <script type="text/javascript" src="{{asset('app/publico/js/lib/jqueryui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('app/publico/js/lib/lobipanel/lobipanel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('app/publico/js/lib/match-height/jquery.matchHeight.min.js')}}">
    </script>
    <script type="text/javascript" src="{{asset('loader/loader.js')}}"></script>


    <script src="{{asset('app/publico/js/app.js')}}">
    </script>

    {{-- form --}}
    <script src="{{asset('app/publico/js/lib/jquery-flex-label/jquery.flex.label.js')}}"></script>

    <script type="application/javascript">
        (function ($) {
        $(document).ready(function () {
            $('.fl-flex-label').flexLabel();
        });
    })(jQuery);
    </script>






</body>

</html>
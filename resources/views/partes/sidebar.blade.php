<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" style="background-color: rgba(104, 186, 72, 0.942); color:black !important">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary"
                    style="    position: absolute;
                z-index: 1;
                margin-left: -39px;">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            
            <div class="p-4 pt-5" style="background-color: rgba(104, 186, 72, 0.942)">
                <h1><a href="index.html" class="logo">PROYECTO CREDISSTE</a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="{!! asset('/') !!}">CREDISSTE</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="{!! asset('/correo') !!}">Correo</a>
                    </li>
                    @auth
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle negro">CRUD</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="{!! asset('users') !!}" class="negro-chikito">
                                    Usuarios
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('roles') !!}" class="negro-chikito">
                                    Roles
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('sugerencias') !!}" class="negro-chikito">
                                    Sugerencias
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('instituciones') !!}" class="negro-chikito">
                                    Instituciones
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('paises') !!}" class="negro-chikito">
                                    Paises
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('pagos') !!}" class="negro-chikito">
                                    Pagos
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('notificaciones') !!}" class="negro-chikito">
                                    Notificaciones
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('municipios') !!}" class="negro-chikito">
                                    Municipios
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('estados') !!}" class="negro-chikito">
                                    Estados
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('documentos') !!}" class="negro-chikito">
                                    Documentos
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('roles') !!}" class="negro-chikito">
                                    Roles
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('detallePagos') !!}" class="negro-chikito">
                                    Detalle Pagos
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('correos') !!}" class="negro-chikito">
                                    Correos
                                </a>
                            </li>
                            <li>
                                <a href="{!! asset('crud') !!}" class="negro-chikito">
                                    PRINCIPAL
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endauth
                   

                </ul>
                <div style="height: 12rem">

                </div>
                <div class="footer">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                    <a href="{!! asset('/crud') !!}" class="link-dark">Regresar CRUD Usuarios</a>

                </div>

            </div>
        </nav>

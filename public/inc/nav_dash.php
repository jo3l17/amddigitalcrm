<div id="nav_dash_arriba" class="pos-f-t">
    <div id="navigation_padre" class="col-12 p-0">
        <ul class="nav-top">
            <li><a id="offcanvas" href="#" data-toggle="offcanvas"><i class="fa fa-bars" aria-hidden="true"></i></a></li>
        </ul>
        <div class="navigation">
            <img id="nav_home" class="img-fluid" src="<?php echo URL . URLIMG . NOMBRE_LOGO_ ?>" alt="">
        </div>
        <ul class="nav-top">
            <li><a href="#" class="nav_clientes_general d-none d-lg-block d-xl-block"><img class="img_nav" src="<?php echo URL . URLIMG ?>cliente.svg">PROSPECTOS&nbsp;<small class="box-new-cliente" v-if="numeroclientes != 0">{{numeroclientes}}</small></a></li>
        </ul>
        <ul class="nav-top">
            <li><a href="#" class="nav_mis_clientes d-none d-lg-block d-xl-block"><img class="img_nav" src="<?php echo URL . URLIMG ?>grupo.svg">MIS CLIENTES</a></li>
        </ul>
        <div class="navigation">
            <ul>
                <li><a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">Marco Antonio Rodriguez Salinas</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="wrapper" class="toggled">
    <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li><a href="#">Inicio</a></li>
            <li class="dropdown">
                <a href="#works" class="dropdown-toggle" data-toggle="dropdown">
                    Módulo Clientes
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu animated fadeInLeft" role="menu">
                    <li><a class="nav_clientes_general" href="#">Prospectos General</a></li>
                    <li><a class="nav_mis_clientes" href="#">Mis Clientes</a></li>
                </ul>
            </li>
            <li><a id="cerrar_sesion" href="#">Cerrar sesión</a></li>
        </ul>
    </nav>
    <div class="container-fluid c-f-corregido">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h4 class="text-white">Collapsed content</h4>
                <span class="text-muted">Toggleable via the navbar brand.</span>
            </div>
        </div>
    </div>
    <div class="container-fluid pr-4 pl-4 pt-3">
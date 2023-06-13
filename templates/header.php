<?php $categorias = $tours->getCategories(); ?>
<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="tel:<?php echo $myWebSite["telefono"]; ?>" id="phone_top"><?php echo $myWebSite["telefono"]; ?></a><span id="opening"><?php echo nl2br($myWebSite["horario_atencion"]); ?></span>
                </div>
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <ul id="top_links">
                        <li>
                        <?php if($nombreAfiliado != ''){ ?>
                            <span class="nombreAfiliado"><?php echo $nombreAfiliado; ?></span>
                        <?php } ?>                            
                        </li>
                        <!-- <li><a href="#0">CLIENTES</a></li> -->
                    </ul>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container-->
    </div>
    <!-- End top line-->

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div id="logo_home">
                    <h1>
                        <a href="/" title="Mujer Viaja" style="background-image: url(img/logo.png);">Mujer viaja</a>
                    </h1>
                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="img/logo.png" width="145" height="34" alt="Mujer Viaja">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    <ul>
                        <li>
                            <a href="/">Inicio</a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">Experiencias</a>
                                <ul>
                                    <li><a href="experiencias">Ver todas las experiencias</a></li>
                                    <?php foreach($categorias["data"] as $categoria){ ?>
                                        <li><a href="experiencias/<?php echo $fn->reemplaza_espacios($categoria["nombre"]); ?>/<?php echo $categoria["id"]; ?>"><?php echo $categoria["nombre"]; ?></a></li>
                                    <?php } ?>
                                </ul>
                        </li>
                        <!-- <li>
                            <a href="#">Tours</a>
                        </li>
                        <li>
                            <a href="#">Hoteles</a>
                        </li> -->
                        <li>
                            <a href="nosotros">Nosotros</a>
                        </li>
                        <li>
                            <a href="#">Cotizaciones especiales</a>
                        </li>
                        <li>
                            <a href="contacto">Contáctanos</a>
                        </li>
                    </ul>

                    <?php if($nombreAfiliado != ''){ ?>
                            <span class="nombreAfiliadoCel"><?php echo $nombreAfiliado; ?></span>
                    <?php } ?>                       
                </div>
                <!-- End main-menu -->
            </nav>
        </div>
    </div>
    <!-- container -->
</header>
<!-- End Header -->
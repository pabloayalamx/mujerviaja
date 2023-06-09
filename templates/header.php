<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="tel:<?php echo $myWebSite["telefono"]; ?>" id="phone_top"><?php echo $myWebSite["telefono"]; ?></a><span id="opening"><?php echo nl2br($myWebSite["horario_atencion"]); ?></span>
                </div>
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <ul id="top_links">
                        <li><a href="#0" id="wishlist_link">MI OFICINA</a></li>
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
                        <a href="index.html" title="City tours travel template" <?php if($logotipo != ''){ ?> style="background-image: url(assets/<?php echo $logotipo; ?>);" <?php } ?>>BesTours Travel&amp;Excursion Multipurpose Template</a>
                    </h1>
                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="img/logo_menu.png" width="145" height="34" alt="Bestours">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    <ul>
                        <li>
                            <a href="index">Inicio</a>
                        </li>
                        <li>
                            <a href="tours">Experiencias</a>
                        </li>
                        <li>
                            <a href="#">Tours</a>
                        </li>
                        <li>
                            <a href="#">Hoteles</a>
                        </li>
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
                </div>
                <!-- End main-menu -->
            </nav>
        </div>
    </div>
    <!-- container -->
</header>
<!-- End Header -->
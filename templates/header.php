<?php $categorias = $tours->getCategories(); ?>
<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php if($afiliado == 0){ ?>
                        <a href="tel:<?php echo $myWebSite["telefono"]; ?>" id="phone_top"><?php echo $myWebSite["telefono"]; ?></a><span id="opening"><?php echo nl2br($myWebSite["horario_atencion"]); ?></span>
                    <?php }else{ ?>
                        <a href="tel:<?php echo $telefono_celular_codigo_pais.$telefono_celular; ?>" id="phone_top"><?php echo $telefono_celular_codigo_pais.$telefono_celular; ?></a><span id="opening"><?php echo nl2br($myWebSite["horario_atencion"]); ?></span>
                    <?php } ?>
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
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div id="logo_home">
                    <h1>
                        <a href="/" title="Mujer Viaja" style="background-image: url(img/logo.png);">Mujer viaja</a>
                    </h1>
                </div>
            </div>
            <nav class="col-md-10 col-sm-10 col-xs-10">
                <ul id="tools_top">
                    <li>
                        <select name="currencyHeader" id="currencyHeader" onchange="changeCurrency(value)">
                            <?php foreach($monedas["data"] as $i => $moneda){ ?>
                                <option value="<?php echo $moneda["iso"] ?>" <?php echo $moneda["iso"]==$monedaSeleccionada ? 'selected' : ''; ?>><?php echo $moneda["iso"] ?></option>    
                            <?php } ?>
                        </select>
                    </li>
                </ul>
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
                        <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">Circuitos</a>
                                <ul>
                                    <li><a href="circuitos-europa" target="_blank">Europa</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=5" target="_blank">África</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=6" target="_blank">Pacífico</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=7" target="_blank">Sudámerica</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=2" target="_blank">Medio oriente</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=9" target="_blank">Centro América</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=10" target="_blank">Cuba y el Caribe</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=13" target="_blank">Cruceros</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=3" target="_blank">Canadá</a></li>
                                    <li><a href="https://www.megatravel.com.mx/tools/vi.php?Dest=8" target="_blank">Estados Unidos</a></li>
                                </ul>
                        </li>                        
                        <li>
                            <a href="tours">Tours</a>
                        </li>
                        <li>
                            <a href="hoteles">Hoteles</a>
                        </li>
                        <li>
                            <a href="nosotros">Nosotros</a>
                        </li>
                        <li class="text-center">
                            <a href="cotizacion-especial">Cotizaciones <br> especiales</a>
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
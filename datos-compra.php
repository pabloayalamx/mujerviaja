<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    $idtour = $_POST["idtour"];
    $imagen = $_POST["imagen"];
    $cadultos = $_POST["cadultos"];
    $cmenores = $_POST["cmenores"];
    $cinfantes = $_POST["cinfantes"];   
    $padulto = $_POST["padulto"];   
    $pmenor = $_POST["pmenor"];   
    $pinfante = $_POST["pinfante"];    
    $nombretour = $_POST["nombretour"]; 
    $fechaviaje = $_POST["fechaviaje"];
    $gtotal = $_POST["gtotal"];  
    $tipohabitacion = $_POST["tipohabitacion"];
    $hoteleria = $_POST["hoteleria"];

    //Aplica solo para circuitos:
    $id_temporada = $_POST["id_temporada"];
    $nombre_temporada = $_POST["nombre_temporada"];
    $id_clase_servicio = $_POST["id_clase_servicio"];
    $nombre_servicio = $_POST["nombre_servicio"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $id_paquete_fecha = $_POST["id_paquete_fecha"];
    $id_temporada_costo = $_POST["id_temporada_costo"]; 
    
    //Recibimos informacion de promocion para tours de 1 dia
    $tipo_descuento_frm = $_POST["tipo_descuento_frm"];
    $valor_promocion_frm = $_POST["valor_promocion_frm"];
    $descuento_frm = $_POST["descuento_frm"];
    $idpromo_frm = $_POST["idpromo_frm"];
    $idexpromo_frm = $_POST["idexpromo_frm"];
    $aplicapromo = $_POST["aplicapromo"];    

    if($aplicapromo == 1 && $tipo_descuento_frm == 1){
        $gtotalPromo = $gtotal - ($gtotal * ($valor_promocion_frm / 100));
    }else{
        $gototalPromo = 0;
    }
?> 

<head>
    <base href="<?php echo $fn->baseMeta(); ?>">
    <title>Resevación en línea</title>
    <meta name="description" content="<?php echo $tour["paquete"][0]["descripcion_sitio"]; ?><">
    <meta name="keywords" content="<?php echo $tour["paquete"][0]["keywords_sitio"]; ?><">
    <?php include("templates/head.php"); ?>
</head>

<body>

    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?php echo $imagen; ?>" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Casi listos para tu próxima aventura</h1>
				<p>"<?php echo $nombretour." te espera con muchas sorpresas!"; ?>"</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-8">
                    <form id="frmCompra" action="save-data-openpay" method="post">
                        <input type="hidden" name="tipohabitacion" id="tipohabitacion" value="<?php echo $tipohabitacion; ?>"> 
                        <input type="hidden" name="hoteleria" value="<?php echo $hoteleria; ?>">
                        <input type="hidden" name="idtour" value="<?php echo $idtour; ?>">
                        <input type="hidden" name="cadultos" value="<?php echo $cadultos; ?>">
                        <input type="hidden" name="cmenores" value="<?php echo $cmenores; ?>">
                        <input type="hidden" name="cinfantes" value="<?php echo $cinfantes; ?>">
                        <input type="hidden" name="padulto" value="<?php echo $padulto; ?>">
                        <input type="hidden" name="pmenor" value="<?php echo $pmenor; ?>">
                        <input type="hidden" name="pinfante" value="<?php echo $pinfante; ?>">
                        <input type="hidden" name="nombretour" id="nombretour" value="<?php echo $nombretour; ?>">
                        <input type="hidden" name="fechaviaje" value="<?php echo $fechaviaje; ?>">
                        <input type="hidden" name="gtotal" id="gtotal" value="<?php echo $gtotal; ?>">
                        <input type="hidden" name="gtotalPromo" id="gtotalPromo" value="<?php echo $gtotalPromo; ?>">
                        <input type="hidden" name="openpayID" id="openpayID">
                        <input type="hidden" name="openpayLINK" id="openpayLINK">

                        <input type="hidden" name="id_temporada" value="<?php echo $id_temporada; ?>">
                        <input type="hidden" name="nombre_temporada" value="<?php echo $nombre_temporada; ?>">
                        <input type="hidden" name="id_clase_servicio" value="<?php echo $id_clase_servicio; ?>">
                        <input type="hidden" name="nombre_servicio" value="<?php echo $nombre_servicio; ?>">
                        <input type="hidden" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
                        <input type="hidden" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
                        <input type="hidden" name="id_paquete_fecha" value="<?php echo $id_paquete_fecha; ?>">
                        <input type="hidden" name="id_temporada_costo" value="<?php echo $id_temporada_costo; ?>"> 
                        
                        <input type="hidden" name="tipo_descuento_frm" id="tipo_descuento_frm" value="<?php echo $tipo_descuento_frm; ?>" >    
                        <input type="hidden" name="valor_promocion_frm" id="valor_promocion_frm" value="<?php echo $valor_promocion_frm; ?>" >   
                        <input type="hidden" name="descuento_frm" id="descuento_frm" value="<?php echo $descuento_frm; ?>">    
                        <input type="hidden" name="idpromo_frm" id="idpromo_frm" value="<?php echo $idpromo_frm; ?>" >    
                        <input type="hidden" name="idexpromo_frm" id="idexpromo_frm" value="<?php echo $idexpromo_frm; ?>" > 
                        <input type="hidden" name="aplicapromo" id="aplicapromo" value="<?php echo $aplicapromo; ?>" > 

                        <h3 class="titulo tituloForm">DATOS DEL TITULAR</h3>
                        <small class="text-danger">TITULAR DE LA TARJETA CON LA QUE SE REALIZARÁ EL PAGO</small>
                        <div>
                            <div class="form-group mb-5">
                                <label for="nombreTitular">Nombres</label>
                                <input required type="text" id="nombreTitular" name="nombre" class="form-control" placeholder="Escriba los nombres del titular de la reserva" autocomplete="off">
                            </div>
                            <div class="form-group mb-5">
                                <label for="apellidoTitular">Apellidos</label>
                                <input required type="text" id="apellidoTitular" name="apellido" class="form-control" placeholder="Escriba los apellidos del titular de la reserva" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="col-md-6">                        
                                    <div class="form-group mb-5">
                                        <label for="telefonoTitular">Teléfono</label>
                                        <input required type="number" id="telefonoTitular" name="telefono" class="form-control" placeholder="Escriba su número de teléfono" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-6">                        
                                    <label for="sexoTitular">Sexo</label>
                                    <select required class="form-control" id="sexoTitular" name="sexoTitular">
                                        <option value="0" selected disabled>Selecciona una opción</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>                                            
                                    </select>
                                </div>                            
                            </div>
                            <div class="form-group mb-5 mt-cel">
                                <label>Fecha de nacimiento</label>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4">
                                        <select required class="form-control" id="dianacTitular" name="dianacTitular">
                                            <option value="0" disabled selected>Día</option>
                                            <?php for($i=1; $i<=31; $i++){?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 col-sm-4">
                                        <select required class="form-control" id="mesnacTitular" name="mesnacTitular">
                                            <option value="0" disabled selected>Mes</option>
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 col-sm-4">
                                        <select required class="form-control" id="yearTitular" name="yearTitular">
                                            <option value="0" disabled selected>Año</option>
                                            <?php for($i=1960; $i<=date('Y'); $i++){?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>                         

                        <?php if($cadultos > 1){ ?>
                            <h3 class="titulo tituloForm"><?php echo $cadultos == 2 ? 'Datos del acompañante adulto' : 'Datos de los acompañantes adultos'; ?></h3>
                            <?php $indiceAdulto = 2; for($e=0; $e < $cadultos-1; $e++){ ?>
                                <div class="contenedoradultos">
                                    <h2>Adulto <?php echo $indiceAdulto; ?></h2>
                                    <div class="form-group mb-5">
                                        <label for="nombreAcompa_<?php echo $indiceAdulto; ?>">Nombres</label>
                                        <input required type="text" id="nombreAcompa_<?php echo $indiceAdulto; ?>" name="nombreAcompa[]" class="form-control" placeholder="Escriba los nombres" autocomplete="off">
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="apellidoAcompa_<?php echo $indiceAdulto; ?>">Apellidos</label>
                                        <input required type="text" id="apellidoAcompa_<?php echo $indiceAdulto; ?>" name="apellidoAcompa[]" class="form-control" placeholder="Escriba los apellidos" autocomplete="off">
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="exampleInputEmail<?php echo $indiceAdulto; ?>">Fecha de nacimiento</label>
                                        <div class="row">
                                            <div class="col-xs-4 col-md-4">
                                                <select required class="form-control" id="dianacAcompa_<?php echo $indiceAdulto; ?>" name="dianacAcompa[]">
                                                    <option value="0" disabled selected>Día</option>
                                                    <?php for($i=1; $i<=31; $i++){?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select required class="form-control" id="mesnacAcompa_<?php echo $indiceAdulto; ?>" name="mesnacAcompa[]">
                                                    <option value="0" disabled selected>Mes</option>
                                                    <option value="1">Enero</option>
                                                    <option value="2">Febrero</option>
                                                    <option value="3">Marzo</option>
                                                    <option value="4">Abril</option>
                                                    <option value="5">Mayo</option>
                                                    <option value="6">Junio</option>
                                                    <option value="7">Julio</option>
                                                    <option value="8">Agosto</option>
                                                    <option value="9">Septiembre</option>
                                                    <option value="10">Octubre</option>
                                                    <option value="11">Noviembre</option>
                                                    <option value="12">Diciembre</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select required class="form-control" id="yearnacAcompa_<?php echo $indiceAdulto; ?>" name="yearnacAcompa[]">
                                                    <option value="0" disabled selected>Año</option>
                                                    <?php for($i=1960; $i<=date('Y'); $i++){?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-5">
                                                <label for="sexoAcompa_<?php echo $indiceAdulto; ?>">Sexo</label>
                                                <select required require class="form-control" id="sexoAcompa_<?php echo $indiceAdulto; ?>" name="sexoAcompa[]">
                                                    <option value="0" selected disabled>Selecciona una opción</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>                                            
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <?php $indiceAdulto++; } ?>                         
                        <?php } ?>

                        <?php if($cmenores > 0){ ?>
                        <h3 class="titulo tituloForm">DATOS DE LOS ACOMPAÑANTES MENORES</h3>
                        <?php $indiceMenor = 1; for($e=0; $e < $cmenores; $e++){ ?>
                        <div class="contenedordemenores">
                            <h2>Menor <?php echo $indiceMenor; ?></h2>
                            <div class="form-group mb-5">
                                <label for="nombreMenor_<?php echo $indiceMenor; ?>">Nombres</label>
                                <input required type="text" id="nombreMenor_<?php echo $indiceMenor; ?>" name="nombreMenor[]" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group mb-5">
                                <label for="apellidoMenor_<?php echo $indiceMenor; ?>">Apellidos</label>
                                <input required type="text" class="form-control" id="apellidoMenor_<?php echo $indiceMenor; ?>" name="apellidoMenor[]" autocomplete="off">
                            </div>
                            <div class="form-group mb-5">
                                <label>Fecha de nacimiento</label>
                                <div class="row">
                                    <div class="col-xs-4 col-md-4">
                                        <select required class="form-control" id="dianacMenor_<?php echo $indiceMenor; ?>" name="dianacMenor[]">
                                        <option value="0" disabled selected>Día</option>
                                            <?php for($i=1; $i<=31; $i++){?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 col-md-4">
                                        <select required class="form-control" id="mesnacMenor_<?php echo $indiceMenor; ?>" name="mesnacMenor[]">
                                        <option value="0" disabled selected>Mes</option>
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 col-md-4">
                                        <select required class="form-control" id="yearnacMenor_<?php echo $indiceMenor; ?>" name="yearnacMenor[]">
                                        <option value="0" disabled selected>Año</option>
                                            <?php for($i=1960; $i<=date('Y'); $i++){?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <label for="sexoMenor_<?php echo $indiceMenor; ?>">Sexo</label>
                                        <select required class="form-control" id="sexoMenor_<?php echo $indiceMenor; ?>" name="sexoMenor[]">
                                            <option value="0" selected disabled>Selecciona una opción</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <?php $indiceMenor++; } ?>
                        <?php } ?>                        

                        <div>
                            <h2 class="text-center">¿A dónde enviamos la confirmación de tu reservación?</h2>
                            <p class="text-center">El e-mail que elijas será fundamental para que gestiones tu reserva</p>
                                <div class="form-group mb-5">
                                    <label for="exampleInputEmail1">E-mail donde recibirás la confirmación de tu reservación</label>
                                    <input required="" type="email" class="form-control" name="email" id="email" placeholder="Escriba su email" required autocomplete="off">
                                </div>                       
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="button" value="Confirmar reservación" class="btn_full" onclick="getLinkPay()" id="btnPagar">
                                        <button id="btnPagarSend" type="submit" class="d-none">x</button>
                                    </div>
                                </div>                        
                        </div>                        
                    </form>                    
				</div>
				<!-- End Col -->

				<aside class="col-md-4">
					<div class="box_style_2">
						<form method="post" action="assets/check_avail.php" id="check_avail" autocomplete="off">
							<input type="hidden" id="tour_name" name="tour_name" value="General Louvre Tour">
							<div class="form-group">
								<label>Fecha del viaje</label>
                                <?php 
                                    if($fechaviaje != ''){
                                        $fechita = $fn->fechaAbreviada($fechaviaje);
                                    }else{
                                        $fechita = $fn->fechaAbreviada($fecha_inicio);                                        
                                    }
                                ?>
                                <input type="text" name="fecha" id="fecha_viaje_input" class="form-control" value="<?php echo $fechita; ?>" disabled>
							</div>  
     
                            <?php
                                if($aplicapromo == 1){
                                    $padulto_old = $padulto;
                                    $pmenor_old = $pmenor;
                                    $pinfante_old = $pinfante;

                                    if($descuento_frm == 1){
                                        //Porcentaje
                                        $padulto = $padulto - ($padulto * ($valor_promocion_frm/100));
                                        $pmenor = $pmenor - ($pmenor * ($valor_promocion_frm/100));
                                        $pinfante = $pinfante - ($pinfante * ($valor_promocion_frm/100));
                                    }else{
                                        //Monto
                                        $padulto = $padulto - $valor_promocion_frm;
                                        $pmenor = $pmenor - $valor_promocion_frm;
                                        $pinfante = $pinfante - $valor_promocion_frm;
                                    }            
                                }
                            ?>                                                                          
							<table id="tickets" class="table">
								<thead>
									<tr>
										<th>Tickets</th>
										<th>Quantity</th>
										<th class="text-center"><span class="subtotal">Subtotal</span></th>
									</tr>
								</thead>
								<tfoot>
									<tr class="total_row">
										<td><strong>TOTAL</strong></td>
										<td colspan="2" class="text-right">
                                        <?php if($aplicapromo == 1){ ?>
                                            <input name="total" class="text-right" id="total" value="<?php echo "$ ".$fn->moneda($gtotalPromo)." ".$monedaSeleccionada; ?>" disabled>                             
                                        <?php }else{ ?>   
                                            <input name="total" class="text-right" id="total" value="<?php echo "$ ".$fn->moneda($gtotal)." ".$monedaSeleccionada; ?>" disabled>                            
                                        <?php } ?>                                             
											
										</td>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td>
                                            <strong>Adultos</strong>
                                            <a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="A partir de 16 años">
                                                <sup class="icon-info-4"></sup>
                                            </a>
											<span id="priceAdulto" class="price">$0</span>
										</td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="adultos" id="adultos" disabled>
                                                    <?php for($i=1; $i<=10; $i++){ ?>
													    <option value="<?php echo $i; ?>" <?php echo $cadultos == $i ? 'selected' : '' ?>><?php echo $i; ?></option>
                                                    <?php } ?>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalAdulto"><?php echo "$ ".$fn->moneda($padulto*$cadultos); ?></span></td>
									</tr>
									<tr>
										<td>
                                            <strong>Menores</strong>
                                            <a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="Entre 3 y 15 años">
                                                <sup class="icon-info-4"></sup>
                                            </a>
                                            <span id="priceMenor" class="price">$0</span>
										</td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="menores" id="menores" disabled>
                                                    <?php for($i=0; $i<=10; $i++){ ?>
													    <option value="<?php echo $i; ?>" <?php echo $cmenores == $i ? 'selected' : '' ?>><?php echo $i; ?></option>
                                                    <?php } ?>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalMenor"><?php echo "$ ".$fn->moneda($pmenor*$cmenores); ?></span>
										</td>
									</tr>
									<tr>
										<td><strong>Infantes</strong> <span id="priceInfante" class="price">$0</span> </td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="infantes" id="infantes" disabled>
                                                    <?php for($i=0; $i<=10; $i++){ ?>
													    <option value="<?php echo $i; ?>" <?php echo $cinfantes == $i ? 'selected' : '' ?>><?php echo $i; ?></option>
                                                    <?php } ?>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalInfante"><?php echo "$ ".$fn->moneda($pinfante*$cinfantes); ?></span></td>
									</tr>
								</tbody>
							</table>                            
						</form>
						<hr>
					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->
    <!-- End container -->

    <footer><?php include("templates/footer.php"); ?></footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_close"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form>
	</div>
	<!-- End Search Menu -->

	<!-- COMMON SCRIPTS -->
	<?php include("templates/js.php") ?>

</body>

</html>
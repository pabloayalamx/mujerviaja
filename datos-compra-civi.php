<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    $imagen      = $_POST["imagen"];
    $idactividad = $_POST["idactividad"];
    $markup      = $_POST["markup"];
    $currency    = $_POST["currency"];
    $precioTotal = $_POST["precioTotal"];
    $categoria   = $_POST["categoria"];
    $campo       = $_POST["campo"];
    $cantidad    = $_POST["cantidad"];
    $fecha       = $_POST["fecha"];
    $horario     = $_POST["horario"];  
    $nombreAct   = $_POST["nombreActividad"];
?> 

<head>
    <base href="<?php echo $fn->baseMeta(); ?>">
    <title>Resevación en línea</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
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
				<p>"<?php echo $nombreAct." te espera con muchas sorpresas!"; ?>"</p>
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
                                <?php echo $fn->fechaAbreviada($fecha); ?>
                                <input type="hidden" name="fecha" id="fecha_viaje_input" class="form-control" value="<?php echo $fecha; ?>" disabled>
							</div>  
     
                                                                         
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
                                            <input name="total" class="text-right" id="total" value="10" disabled>                                              											
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
                                                    <option value=""></option>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalAdulto">10</span></td>
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
                                                    <option value=""></option>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalMenor">10</span>
										</td>
									</tr>
									<tr>
										<td><strong>Infantes</strong> <span id="priceInfante" class="price">$0</span> </td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="infantes" id="infantes" disabled>
                                                    <option value=""></option>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalInfante">10</span></td>
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

	<!-- COMMON SCRIPTS -->
	<?php include("templates/js.php") ?>

</body>

</html>
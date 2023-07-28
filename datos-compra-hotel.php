<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    $hash      = $_GET["hash"];
    $id        = $_GET["id"];
    $checkin   = $_GET["checkin"];
    $checkout  = $_GET["checkout"];
    $adults    = $_GET["adults"];
    $menores   = $_GET["menores"];
    $fx        = $_GET["fx"];
    $room      = $_GET["room"];
    $pr        = $_GET["pr"];
    $meal      = $_GET["meal"];
    $cur       = $_GET["cur"];
    $residency = $_GET["residency"];
    $lan       = $_GET["lan"];
    $hotelName = $_GET["hotelName"];
    $imagen    = $_GET["foto"];

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
				<p>"<?php echo $hotelName." te espera con muchas sorpresas!"; ?>"</p>
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
                    <form id="frmCompra" action="save-data-openpay-hotel" method="post">
                        <input type="hidden" name="nombrehotel" id="nombrehotel" value="<?php echo $hotelName; ?>">
                        <input type="hidden" name="openpayID" id="openpayID">
                        <input type="hidden" name="openpayLINK" id="openpayLINK">
                        <input type="hidden" name="gtotal" id="gtotal" value="<?php echo $pr; ?>">
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
                                        <input type="button" value="Confirmar reservación" class="btn_full" onclick="getLinkPayHotel()" id="btnPagar">
                                        <button id="btnPagarSend" type="submit" class="d-none">x</button>
                                    </div>
                                </div>                        
                        </div>                        
                    </form>                    
				</div>
				<!-- End Col -->
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
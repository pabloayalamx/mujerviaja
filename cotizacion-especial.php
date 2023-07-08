<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   

<head>
    <title>Cotizaciones especiales</title>    
    <meta name="description" content="">
    <meta name="keywords" content="">	
    <?php include("templates/head.php"); ?>

    <!-- JQUERY UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<div id="header_1"><?php include("templates/header.php"); ?></div>

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/contacto.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>¿Deseas un itinerario especial?</h1>
				<p>Completa el formulario y te contactaremos para buscar la mejor tarifa</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper add_bottom_30">
	<div class="divider_border"></div>
		<div class="container">
			<div class="row">

				<aside class="col-md-3">
					<div class="box_style_2">
						<h4 class="nomargin_top">Información de contacto</h4>
						<p>
						<?php if($afiliado > 0){ ?>
							<p>
								<span class="tituloContacto">Nombre: </span><br>
								<?php echo $nombreAfiliado; ?><br><br>

								<span class="tituloContacto">Email: </span><br>
								<a href="mailto:<?php echo $emailAfiliado; ?>" class="linkcontacto"><?php echo $emailAfiliado; ?></a><br><br>	
								
								<span class="tituloContacto">Teléfono: </span><br>
								<a href="tel:<?php echo $telefono_oficina_codigo_pais.$telefono_oficina; ?>" class="linkcontacto"><?php echo "(".$telefono_oficina_codigo_pais.") ".$telefono_oficina; ?></a><br><br>

								<?php if($img_afiliado != ''){ ?>
									<img src="https://app.bookingtrap.com/public/storage/<?php echo $img_afiliado; ?>" alt="<?php echo $nombreAfiliado; ?>" class="img-responsive">
								<?php } ?>
							</p>
						<?php }else{ ?>
								<span class="tituloContacto">Email: </span><br>
								<a href="mailto:<?php echo $myWebSite["email_publico"]; ?>"><?php echo $myWebSite["email_publico"]; ?></a><br><br>	
								
								<span class="tituloContacto">Teléfono: </span><br>
								<?php echo $myWebSite["telefono"]; ?><br><br>	
						<?php } ?>
						</p>
					</div>
				</aside>
				<!--End aside -->

				<div class="col-md-9">
					<div id="paso1">
						<h3 class="tituloCotizacion">Cotización especial</h3>
						<div>
							<form method="post" action="gracias-cotizacion" id="cotizacionEspecial" autocomplete="off">
								<input type="hidden" name="email_afiliado" id="email_afiliado" value="<?php echo $afiliado > 0 ? $emailAfiliado : ''; ?>">
								<input type="hidden" name="nombre_afiliado" id="nombre_afiliado" value="<?php echo $afiliado > 0 ? $nombreAfiliado : ''; ?>">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Nombre</label>
											<input type="text" required class="form-control styled" id="name_contact" name="name_contact" placeholder="Nombre">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Apellido</label>
											<input type="text" required class="form-control styled" id="lastname_contact" name="lastname_contact" placeholder="Apellido">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Email:</label>
											<input type="email" required id="email_contact" name="email_contact" class="form-control styled" placeholder="Escribe tu email">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Teléfono:</label>
											<input type="number" required id="phone_contact" name="phone_contact" class="form-control styled" placeholder="10 dígitos">
										</div>
									</div>
								</div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Fecha del viaje:</label>
											<input type="text" required id="fecha" name="fecha" class="form-control styled" placeholder="Selecciona una fecha">
										</div>
									</div>
									<div class="col-6 col-md-3 col-sm-3">
                                        <div class="form-group">
											<label>Adultos:</label>
											<select name="adultos" id="adultos" class="form-control">
                                                <?php for($i=1; $i<=30; $i++){ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
										</div>
									</div> 
                                    <div class="col-6 col-md-3 col-sm-3">
										<div class="form-group">
											<label>Menores:</label>
											<select name="menores" id="menores" class="form-control" onchange="menoresEdadesForm(value)">
                                                <?php for($i=0; $i<=30; $i++){ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
										</div>
									</div>                                                                        
                                </div>

                                <div class="row">
                                    <?php for($i=1; $i<=30; $i++){ ?>
                                    <div class="col-4 col-sm-2 oculto" id="edad_<?php echo $i; ?>">
                                        <div class="form-group">
											<label>Edad:</label>
											<select name="edad[]" class="form-control">
                                                <?php for($e=0; $e<=17; $e++){ ?>
                                                    <option value="<?php echo $e; ?>"><?php echo $e; ?></option>
                                                <?php } ?>
                                            </select>
										</div>                                        
                                    </div>
                                    <?php } ?>
                                </div>

                                <h3 class="tituloCotizacion">Vuelos</h3>

                                <div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>¿Requiere vuelos?:</label>
											<select name="vuelos" id="vuelos" class="form-control" onchange="mostrarDiv('vueloOrigen', '1', value)">
                                                <option value="0" selected>No</option>
                                                <option value="1">Sí</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 oculto" id="vueloOrigen">
										<div class="form-group">
											<label>Saliendo de:</label>
                                            <input type="text" name="origenes" id="origenes" class="form-control" placeholder="Escriba origen y cantidad, ejemplo: CDMX: 1, Cancun: 2...">
										</div>
									</div>                                    
                                </div>

                                <h3 class="tituloCotizacion">Hospedaje</h3>                               

                                <div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>¿Requiere hospedaje?:</label>
											<select name="hospedaje" id="hospedaje" class="form-control" onchange="mostrarHospedaje(value)">
                                                <option value="0" selected>No</option>
                                                <option value="1">Sí</option>
                                            </select>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 oculto" id="numeroHabs">
										<div class="form-group">
											<label>Cantidad de habitaciones:</label>
                                            <select name="numeroHabitaciones" id="numeroHabitaciones" class="form-control" onchange="muestraHabs(value)">
                                            <option value="0" selected disabled>Seleccione...</option>
                                                <?php for($i=1; $i<=30; $i++){ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
										</div>
									</div>                                     
                                </div>

                                <?php for($i=1; $i<=30; $i++){ ?>
                                <div class="row habitaciones oculto <?php echo $i % 2 == 0 ? 'azul' : '' ?>" id="hab_<?php echo $i; ?>">
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label>Tipo de habitación:</label>
											<select name="tipoHab[]" class="form-control">
                                                <option value="0" disabled selected>Seleccione...</option>
                                                <option value="Sencilla">Sencilla</option>
                                                <option value="Doble">Doble</option>
                                                <option value="Triple">Triple</option>
                                                <option value="Cuadruple">Cuadruple</option>
                                            </select>
										</div>
									</div>    
                                    
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label>Adultos:</label>
											<select name="adultosHab[]" class="form-control">
                                                <option value="0" disabled selected>Seleccione...</option>
                                                <?php for($a=1; $a<=4; $a++){ ?>
                                                    <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                                <?php } ?>
                                            </select>
										</div>
									</div> 
                                    
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label>Menores:</label>
											<select name="menoresHab[]" class="form-control">
                                                <option value="0" disabled selected>Seleccione...</option>
                                                <?php for($m=1; $m<=4; $m++){ ?>
                                                    <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                                <?php } ?>
                                            </select>
										</div>
									</div>                                      
                                </div>
                                <?php } ?>


								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Peticiones especiales:</label>
											<textarea rows="5" id="message_contact" name="message_contact" class="form-control styled" style="height:100px;" placeholder="Escribe tus comentarios"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<p>
											<input form="cotizacionEspecial" type="submit" value="Enviar" class="btn_1">
											<div id="message-contact"></div>
										</p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- End col lg 9 -->
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<footer><?php include("templates/footer.php"); ?></footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<?php include("templates/js.php") ?>

	<!-- SPECIFIC SCRIPTS -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#fecha").datepicker({
                changeMonth: true, 
                changeYear: true,                 
                dateFormat: 'yy-mm-dd',
                minDate: 1,
				maxDate: 365,
				monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'], 			  				               
                onSelect: function(dateText) {

                }                 
            });	            
        });
    </script>
</body>

</html>
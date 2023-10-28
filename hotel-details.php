<!DOCTYPE html>
<?php
include("templates/language.php");
include("class/allclass.php");

$form["id"] = $_GET["idhotel"];
$form["checkin"] = $_GET["checkin"];
$form["checkout"] = $_GET["checkout"];
$form["adults"] = $_GET["adultos"];
$form["menores"] = $_GET["menores"];
$form["residency"] = $_GET["nacionalidad"];

$comision = intval($_GET["markup"]);
$menores  = $_GET["menores"];

$detHotel     = $hotels->getHotelInfo($form);
$tarifasHotel = $detHotel["tarifas"];
$infoRes      = $tarifasHotel["debug"]["request"];
$dataRooms    = $tarifasHotel["data"]["hotels"][0]["rates"];

$infoHotel    = $detHotel["infoHotel"][0];
$imagenes     = json_decode($infoHotel["images"]);
$description  = json_decode($infoHotel["description_struct"]);
$amenities    = json_decode($infoHotel["amenities"]); 

$reserva      = $detHotel["reserva"];
$idhotelBD    = $infoHotel["id"];

$hotelAds     = $detHotel["hotelAds"];
?>

<head>
	<base href="<?php echo $fn->baseMeta(); ?>">
	<title><?php echo $infoHotel["hotelName"] ?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<?php include("templates/head.php"); ?>

	<!-- SPECIFIC CSS -->
	<!-- <link href="css/date_time_picker.css" rel="stylesheet"> -->
	<link href="css/timeline.css" rel="stylesheet">

	<!-- JQUERY UI -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
	<div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="https://app.bookingtrap.com/public/storage/empresas/19/excursiones/111/imagenes/Hx4RnHMlgW-1687583471.png" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1><?php echo $infoHotel["hotelName"] ?></h1>
				<p>"<?php echo $infoHotel["hotelName"] ?>" te espera para pasar las mejores vacaciones</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="owl-carousel owl-theme carousel_detail add_bottom_15">
						<?php 
							foreach($imagenes as $i => $imagen){ 
							$imgLink = str_replace("{size}", "x500", $imagen); 
							if($i==0){
								$imgPral = $imgLink;
							}
						?>
							<div class="item"><img src="<?php echo $imgLink ?>" alt="" height="500px"></div>
						<?php } ?>
					</div>

					<div class="row listaHabitaciones mt-2 table-responsive">
						<table class="table table-bordered text-center tablePrecios">
							<thead>
								<tr>
									<td>Habitación</td>
									<td>Alimentos</td>
									<td>Política de <br> cancelación</td>
									<td>Precio</td>
									<td></td>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td>Habitación</td>
									<td>Alimentos</td>
									<td>Política de <br> cancelación</td>
									<td>Precio</td>
									<td></td>
								</tr>
							</tfoot>
							<tbody>
								<!-- INICIA FOREACH PARA MOSTRAR HABITACIONES -->
								<?php 
									foreach($dataRooms as $data){
										$currency = $data["payment_options"]["payment_types"][0]["show_currency_code"];                            
										$daily_prices = $data["daily_prices"];
										$precio = 0;
										$tablePrecios = '<div class="Heading">';
										$listaPrecios = count($daily_prices);
										$amenidades = $data["amenities_data"];
										$roomsAvailable = $data["allotment"];
			
										$impuestos = $data["payment_options"]["payment_types"][0]["tax_data"]["taxes"];
										$txtImpuestos = '';
										foreach($impuestos as $impuesto){
											$claveimpuesto = array_search($impuesto["name"], array_column($hotelAds, 'name'));   
											$txtImpuestos .= '<br />'.$hotelAds[$claveimpuesto]["es"].": ".$impuesto["amount"]." ".$impuesto["currency_code"];
											$txtImpuestos .= $impuesto["included_by_supplier"] == true ? '(Incluido)' : '(No incluido)';
										}
			
										$premeal    = $data["meal"];
										$claveMeal  = array_search($data["meal"], array_column($hotelAds, 'name'));   
										$nombreMeal = $hotelAds[$claveMeal]["es"];
			
										if($data["allotment"] == 1){
											$allotment = '<small class="text-danger">Sólo queda '.$data["allotment"].' habitación </small>';
										}else{
											$allotment = '<small class="text-success">Quedan '.$data["allotment"].' habitaciones</small>';
										}
										
										foreach($daily_prices as $key => $price){
											$fechaCobrada = $fn->sumaFechas($infoRes["checkin"], $key);
											$precio = $precio + $price;
											$tablePrecios .='<div class="Cell"><p>'.$fn->fechaYearOut($fechaCobrada).'</p></div>';
										}
										$tablePrecios.='</div>';
			
										$totalPrecio = $fn->tarifaPublicaAgencias($precio);                           
										$totalPrecioPublico = $totalPrecio / (1 - ($comision / 100));
			
										$tablePrecios .= '<div class="Row">';
										foreach($daily_prices as $key => $price){
											$fechaCobrada = $fn->sumaFechas($infoRes["checkin"], $key);
												$priceShow = $totalPrecio/$listaPrecios;
												$tablePrecios .='<div class="Cell"><p>$'.number_format($priceShow, 2, '.', ',').'</p></div>';
											}
										$tablePrecios.='</div>';                        
																	
			
										$cancelacion = $data["payment_options"]["payment_types"][0]["cancellation_penalties"]["policies"];
										$free_cancelation = $data["payment_options"]["payment_types"][0]["cancellation_penalties"]["free_cancellation_before"];    
										if($free_cancelation != null){
											$fecha = explode("T", $free_cancelation);
											$fecha_cancelation = $fn->restaFechas($fecha[0], 1);
											$fecha_cancelation = "<small>Hasta ".$fn->fechaYearOut($fecha_cancelation)."</small>";
											$hora_cancelation = $fecha[1];                                
			
											$txtCancelation = '<ul>';
											foreach($cancelacion as $dataCancelation){
												$subtotalCargo = $dataCancelation["amount_show"];
												$totalCargo = $fn->tarifaPublicaAgencias($subtotalCargo);
			
												$txtCancelation .= "<li><i class='far fa-check-circle'></i>Cargo de <b>$".number_format($totalCargo, 2, '.', ',')."</b> ".$currency;
												if($dataCancelation["start_at"] != ''){
													$desde = $fn->restaFechas(date("Y-m-d", strtotime($dataCancelation["start_at"])), 1);
													$horaDesde = date("H:i:s", strtotime($dataCancelation["start_at"]));
													$txtCancelation .= " desde <b>".$desde." (".$horaDesde."*)</b>";
												}
			
												if($dataCancelation["end_at"] != ''){
													$hasta = $fn->restaFechas(date("Y-m-d", strtotime($dataCancelation["end_at"])), 1);
													$horaHasta = date("H:i:s", strtotime($dataCancelation["end_at"]));                                    
													$txtCancelation .= " hasta el <b>".$hasta." (".$horaHasta."*)</b>";
												}else{
													$txtCancelation .="</li>";
												}
											}
											$txtCancelation .= '</ul><b>* <span class="text-danger">Tu hora local (UTC -5:00)</span></b>';                                
										}else{
											$fecha_cancelation = "";
											$txtCancelation = "<ul><li><i class='far fa-check-circle'></i>Si se cancela la tarifa no es reembolsable</li></ul>";
										} 	
								?>
									<tr>
										<td>
											<h3><?php echo $data["room_data_trans"]["main_name"]; ?></h3>
											<small class="text-primary"><?php echo $allotment; ?></small>
											<ul>
												<?php 
												foreach ($amenidades as $amenidad){ 
													$claveAmenidad  = array_search($amenidad, array_column($hotelAds, 'name'));   
													$nombreAmenidad = $hotelAds[$claveAmenidad]["es"]; 	
												?>
													<li><?php echo $nombreAmenidad; ?></li>
												<?php } ?>
											</ul>
										</td>
										<td class="text-center">
											<?php echo $nombreMeal; ?>
										</td>

										<td class="text-center">
											<p class="helper <?php echo $free_cancelation == null ? 'text-danger bold' : 'text-success'; ?>" data-toggle="popover" data-content="<p>Contenido html</p>" content="contenido" title="Política de cancelación">
												<?php echo $free_cancelation == null ? 'Tarifa NO cancelable' : '$0 '.$monedaSeleccionada; ?>
												<small>
													<i class="fas fa-question-circle">
													</i>
												</small>
												<br>
												<small><?php echo $fecha_cancelation; ?></small>
											</p>
										</td>
										<td class="text-center">
											<p class="text-primary">
												<?php echo "$".number_format($totalPrecioPublico, 2, '.', ',')." ".$monedaSeleccionada; ?>
											</p>
										</td>
										<td class="text-center">
										<?php     
											if($free_cancelation == null){
												$fx = 0;
											}else{
												$fx = $fn->restaFechas($fecha[0], 1);
											}

											$hotelID = $reserva["id"];
											$linkForm = "hash=".$data["book_hash"]."&id=".$hotelID."&checkin=".$reserva["checkin"]."&checkout=".$reserva["checkout"];
											$linkForm.= "&adults=".$reserva["guests"][0]["adults"]."&menores=".($menores == 'cero' ?  '0' : $menores)."&fx=".$fx;
											$linkForm.= "&room=".$data["room_data_trans"]["main_name"]."&pr=".$totalPrecioPublico;   
											$linkForm.= "&meal=".$data["meal"]."&cur=".$monedaSeleccionada."&hotbd=".$idhotelBD."&residency=".$reserva["residency"]."&lan=".$reserva["language"];
											$linkForm.= "&hotelName=".$infoHotel["hotelName"]."&foto=".$imgPral."&marte=".$comision;
										?>											
											<a href="datos-compra-hotel?<?php echo $linkForm; ?>">
												<button type="button" class="btn-primary">ELEGIR</button>
											</a>
										</td>
									</tr>
								<?php } ?>
								<!-- TERMINA FOREACH PARA MOSTRAR HABITACIONES -->
							</tbody>
						</table>
					</div>


					<div class="row">
						<div class="col-12">
							<div class="panel panel-default mt-2">
								<div class="panel-heading">
									<h3 class="panel-title">Acerca del hotel</h3>
								</div>
								<div class="panel-body">
									<?php foreach ($description as $des){ ?>
										<h5 class="w-100"><?php echo $des->title ?></h5>
                						<p class="w-100"><?php echo $des->paragraphs[0]; ?></p> 										
									<?php } ?>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="panel panel-default mt-2">
								<div class="panel-heading">
									<h3 class="panel-title">Servicios que ofrece el hotel</h3>
								</div>
								<div class="panel-body serviciosLi">
									<?php 
										foreach ($amenities as $amenity){ 
										$listaAmenidades = $amenity->amenities;
									?>
									<div class="col-12 col-sm-4 mb-2">
										<li>
											<i class="fas fa-check-circle decoraLista"></i>
											<h6 class="tituloLista"><?php echo $amenity->group_name; ?></h6>
										</li> 

											<?php foreach($listaAmenidades as $amenityDet){ ?>
											<li>
												<i class="far fa-check-circle"></i>
												<?php echo $amenityDet; ?>
											</li> 										
											<?php } ?>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="panel panel-default mt-2">
								<div class="panel-heading">
									<h3 class="panel-title">Condiciones del check-in</h3>
								</div>
								<div class="panel-body">
									<i class="far fa-clock"></i>
									Check-in y check-out <br>

									<div class="w-100 mb-2">
										<label cklass="w-100">Checkin</label>
										<p>Después de las <?php echo $infoHotel["check_in_time"]; ?></p>
									</div>

									<div class="w-100">
										<label cklass="w-100">Checkout</label>
										<p>Hasta las <?php echo $infoHotel["check_out_times"]; ?></p>
									</div> 
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="panel panel-default mt-2">
								<div class="panel-heading">
									<h3 class="panel-title">Información adicional</h3>
								</div>
								<div class="panel-body">
									<p><?php echo $infoHotel["metapolicy_extra_info"]; ?></p>
								</div>
							</div>
						</div>

					</div>

					<!-- End tabs -->
				</div>
				<!-- End Col -->

			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div>
	</div>

	<br><br><br>
	<!-- End container -->

	<!-- Footer -->
	<footer><?php include("templates/footer.php"); ?></footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
	<?php include("templates/js.php") ?>

	<!-- SPECIFIC SCRIPTS -->
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->


	<script src="js/sidebar_carousel_detail_page_func.js"></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script> -->
	<script src="js/infobox.js"></script>

	<script>
		$(document).ready(function() {
			// $('.helper').popover({
			// 	container: 'body'
			// })

			$('.helper').popover({
            html: true,
            placement:'top',
            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
        }); 			
		});
	</script>
</body>

</html>

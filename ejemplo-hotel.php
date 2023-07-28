<!DOCTYPE html>
<?php
include("templates/language.php");
include("class/allclass.php");
?>

<head>
	<base href="<?php echo $fn->baseMeta(); ?>">
	<title>NOMBRE DEL HOTEL</title>
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
				<h1>NOMBRE DEL HOTEL</h1>
				<p>"NOMBRE DEL HOTEL" te espera para pasar las mejores vacaciones</p>
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
						<div class="item"><img src="https://app.bookingtrap.com/public/storage/empresas/19/excursiones/111/imagenes/Hx4RnHMlgW-1687583471.png" alt="" height="422px"></div>
						<div class="item"><img src="https://app.bookingtrap.com/public/storage/empresas/19/excursiones/111/imagenes/Hx4RnHMlgW-1687583471.png" alt="" height="422px"></div>
						<div class="item"><img src="https://app.bookingtrap.com/public/storage/empresas/19/excursiones/111/imagenes/Hx4RnHMlgW-1687583471.png" alt="" height="422px"></div>
					</div>

					<div class="row listaHabitaciones mt-2">
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
								<?php for ($i = 0; $i <= 10; $i++) { ?>
									<tr>
										<td>
											<h3>Nombre de la habitación</h3>
											<small class="text-primary">Quedan 2 habitaciones</small>
											<ul>
												<li>Condicion 1</li>
												<li>Condicion 2</li>
												<li>Condicion 3</li>
											</ul>
										</td>
										<td class="text-center">
											No se incluyen alimentos
										</td>

										<td class="text-center">
											<p class="helper" data-toggle="popover" data-content="Disabled popover" title="Titilo">
												$0 MXN
												<small>
													<i class="fas fa-question-circle">
													</i>
												</small>
												<br>
												<small>Hasta el 23/Agosto</small>
											</p>
										</td>
										<td class="text-center">
											<p class="text-primary">
												$1,265.69 MXN
											</p>
										</td>
										<td class="text-center">
											<a href="">
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
									<p>Descripcion del htoel</p>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="panel panel-default mt-2">
								<div class="panel-heading">
									<h3 class="panel-title">Servicios que ofrece el hotel</h3>
								</div>
								<div class="panel-body">
									<p>Informacion adicional del hotel</p>
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
									Check-in y check-out

									<label cklass="w-100">Checkin</label>
									<p>Después de las 15:00:00</p>

									<label cklass="w-100">Checkout</label>
									<p>Hasta las 12:00:00</p>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="panel panel-default mt-2">
								<div class="panel-heading">
									<h3 class="panel-title">Información adicional</h3>
								</div>
								<div class="panel-body">
									<p>Informacion adicional del hotel</p>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


	<script src="js/sidebar_carousel_detail_page_func.js"></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script> -->
	<script src="js/infobox.js"></script>

	<script>
		$(document).ready(function() {
			$('.helper').popover({
				container: 'body'
			})
		});
	</script>
</body>

</html>
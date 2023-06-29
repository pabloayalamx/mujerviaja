<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    if(isset($_GET["nombreDestino"])){
        $form["lang"]     = $_GET["lang"];
        $form["currency"] = $_GET["currency"];
        $form["id"]       = $_GET["destino_tours"];
        $civitatis        = $tours->getActivitiesCivitatis($form);
    }
?>   

<head>
    <title>Descubre los mejores tours para mujeres en todo el mundo</title>    
    <meta name="description" content="Tours en todo el mundo para mujeres">
    <meta name="keywords" content="tours para mujeres, actividades turisticas para mujeres">	
    <?php include("templates/head.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/tours.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">

			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border_gray"></div>
		<!-- <div id="filters" class="clearfix">
			<div id="sort_filters">
				<select name="orderby" class="selectbox">
					<option value="popularity">Sort by Popularity</option>
					<option value="rating">Sort by Average Rating</option>
					<option value="date" selected='selected'>Sort by Newness</option>
					<option value="price">Sort by Price: Low to High</option>
					<option value="price-desc">Sort by Price: High to Low</option>
				</select>
			</div>
			<div id="view_change">
				<a href="grid.html" class="grid_bt"></a>
				<a href="list.html" class="list_bt"></a>
			</div>
		</div> -->
		<!-- End filters -->

		<div class="container">
            <!-- INICIA MOTOR -->
            <div class="row borderMotor">
                <div class="col-12">

                    <!-- INICIA MOTOR -->
                    <div class="row">
                        <form id="form-buscar" action="tours" method="GET">
                            <div class="col-12 col-sm-5 text-left cajamotor">
                                <div class="form-group">
                                    <input type="hidden" name="nombreDestino" id="nombreDestino" value="<?php if(isset($_GET["nombreDestino"])){ echo $_GET["nombreDestino"]; } ?>">
                                    <input type="hidden" name="lang" id="lang" value="es">
                                    <input type="hidden" name="currency" id="currency" value="<?php echo $fn->minusculas($monedaSeleccionada); ?>">
                                    <select name="destino_tours" id="destino_tours" class="form-control">
                                    <?php if(isset($_GET["nombreDestino"])){ ?> <option value="<?php echo $_GET["destino_tours"]; ?>"><?php echo $_GET["nombreDestino"]; ?></option>  <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-3 cajamotor">
                                <button form="form-buscar" class="btn btn-primary w-100 btnMotor" type="submit">
                                    BUSCAR
                                </button>                                                    
                            </div>
                        </form>
                    </div>                       
                    <!-- TERMINA MOTOR -->
                </div>
            </div>            
            <!-- TERMINA MOTOR -->


            <?php if(isset($_GET["nombreDestino"])){ ?>
            <?php foreach($civitatis->actividades as $i => $actividad){ ?>
			<div class="row strip_list wow fadeIn animated" data-wow-delay="0.2s">
				<div class="col-md-5">
					<div class="img_wrapper">
						<!-- <div class="ribbon">
							<span>Popular</span>
						</div> -->
						<div class="price_grid">
							<sup>$</sup> <?php echo $actividad->minimumPrice; ?> <small><?php echo $actividad->currency; ?></small>
						</div>
						<div class="img_container">
							<a href="tour/">
								<img src="<?php echo $actividad->photos->gallery[0]->paths->thumbnail; ?>" width="800" height="533" class="img-responsive img-responsive-height" alt="Nombre de la actividad">
								<div class="short_info">
                                    <?php
                                        if($actividad->duration->duration/60 > 24){
                                            $horas = $actividad->duration->duration/60;
                                            $dias = $horas/24;                                            
                                    ?>
									    <em>Duración <?php echo $dias; ?> <?php echo $dias > 1 ? 'días' : 'día'; ?></em>
                                    <?php }else{ ?>
                                        <em>Duración <?php echo $actividad->duration->duration/60; ?> <?php echo $actividad->duration->duration/60 > 1 ? 'Horas' : 'Hora' ?></em>
                                    <?php } ?>
									<div class="score_wp">Tripadvisor
										<div class="score"><?php echo $actividad->score < 5 ? '7.5' : $actividad->score.".0"; ?></div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>
				<div class="col-md-7">
					<h3><?php echo $actividad->title; ?></h3>
					<p><?php echo $actividad->raw_description; ?></p>
					<p>
						<a href="tour/" class="btn_1">Ver tour</a>
					</p>
				</div>
			</div>
            <?php } ?>
            <?php } ?>
			<!-- End strip list -->

			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div class="container margin_60">
		<div class="banner">
			<h3>Reserva con anticipación y paga poco a poco tus tours. Para más información contáctanos</h3>
			<a href="contacto" class="btn_1 white">contáctanos ahora mismo</a>
		</div>
		<!-- end banner -->
	</div>
	<!-- end container -->

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

    <!-- Scripts -->  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/jquery.selectbox-0.2.js"></script>
    <script>
        $(document).ready(function(){

            $(".selectbox").selectbox();

            $('#destino_tours').select2({                
                minimumInputLength: 3,
                dropdownPosition: 'below',
                allowClear: true,
                width: 'resolve',
                placeholder: 'Escribe un destino',
                language: "es",                          
                ajax: {
                    url: 'destination-tours',
                    delay: 150,
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            search: params.term
                        }
                            return query;
                            
                    }                            
                },
				  templateResult: function (data) {
					var $result = $("<span class='optgroup'></span>");
                    var $list = $("<span></span>");

                    if(data.text === 'Regiones' || data.text === 'Hoteles'){
                        $result.text(data.text);
                        return $result;
                    }else{
                        $list.text(data.text);
                        return $list;
                    }
				  }                      
            });  
            
            $('#destino_tours').on('select2:select', function (e) {
                var data = e.params.data;
                $("#nombreDestino").val(data.text);
            });    
            
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });                
        });
    </script>    

</body>

</html>
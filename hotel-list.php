<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    $idRegion                = filter_input(INPUT_POST, "destino_tours", FILTER_DEFAULT);
    $nombreDestino           = filter_input(INPUT_POST, "nombreDestino", FILTER_DEFAULT);
    $adultos                 = intval(filter_input(INPUT_POST, "adultos", FILTER_SANITIZE_NUMBER_INT));
    $menoresInput            = filter_input(INPUT_POST, "menores", FILTER_SANITIZE_NUMBER_INT); //Sirve para contabilizar la cantidad de huespedes 
    $menoresTxt              = $menoresInput > 0 ? implode(",", $_POST["edad"]) : '0';

    $checkinDate             = filter_input(INPUT_POST, "checkin", FILTER_DEFAULT);
    $checkoutDate            = filter_input(INPUT_POST, "checkout", FILTER_DEFAULT);
    // echo "checkin: ".$checkinDate." - checkout: ".$checkoutDate;
    $residency               = "MX";
    $currency                = $monedaSeleccionada;
    $language                = "es";

    if(isset($_POST["edad"])){
        foreach($_POST["edad"] as $i => $edad){
            $menoresarray[$i] = intval($edad);
        }
    }else{
        $menoresarray = [];
    }

    $guests["adults"]        = $adultos;
    $guests["children"]      = $menoresarray;

    $formHotels["region_id"] = intval($idRegion);
    $formHotels["checkin"]   = $checkinDate;
    $formHotels["checkout"]  = $checkoutDate;
    $formHotels["currency"]  = $currency;
    $formHotels["residency"] = $residency;
    $formHotels["language"]  = $language;
    $formHotels["guests"][]  = $guests;

    // echo json_encode($formHotels);

    $dataHotels              = $hotels->getHotelsByRegion($formHotels);
    $markup                  = $dataHotels["comision"][0]["comision_hoteleria"];
    $hoteles                 = $dataHotels["hoteles"]["data"]["hotels"];
    $hotelsBDs               = $dataHotels["hotelesBD"];
    $hotelAds                = $dataHotels["hotelAds"];    
?>   

<head>
    <title>Descubre los mejores hoteles en todo el mundo</title>    
    <meta name="description" content="Hoteles en todo el mundo para mujeres">
    <meta name="keywords" content="hoteles para mujeres, hoteles todo incluido para mujeres">	
    <?php include("templates/head.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                <h1>Nuestros hoteles</h1>
				<p>Estás a unos clics de reservar el mejor hotel del destino seleccionado</p>
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
                    <form id="form-buscar" action="tours" method="GET">
                        <div class="row">
                            <h3 class="tituloMotor">¿A dónde quieres ir?</h3>                        
                            <div class="col-12 col-sm-5 text-left cajamotor">
                                <div class="form-group">
                                    <input type="hidden" name="nombreDestino" id="nombreDestino" value="<?php if(isset($_POST["nombreDestino"])){ echo $_POST["nombreDestino"]; } ?>">
                                    <input type="hidden" name="lang" id="lang" value="es">
                                    <label for="">Busca tu destino</label>
                                    <select name="destino_tours" id="destino_tours" class="form-control">
                                    <?php if(isset($_POST["nombreDestino"])){ ?> <option value="<?php echo $_POST["destino_tours"]; ?>"><?php echo $_POST["nombreDestino"]; ?></option>  <?php } ?>
                                    </select>
                                </div>                             
                            </div>

                            <div class="col-12 col-sm-3 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Checkin / Checkout</label>
                                    <input type="text" id="fechas" name="fechas" class="form-control" >
                                </div>                             
                            </div> 
                            
                            <div class="col-12 col-sm-2 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Adultos</label>
                                    <select name="adultos" id="adultos" class="form-control">
                                        <?php for($i=0; $i<=10; $i++){ ?>
                                            <option value="<?php echo $i; ?>" <?php echo $adultos == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                             
                            </div>  
                            
                            <div class="col-12 col-sm-2 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Menores</label>
                                    <select name="menores" id="menores" class="form-control" onchange="menoresEdades(value)">
                                        <?php for($i=0; $i<=4; $i++){ ?>
                                            <option value="<?php echo $i; ?>" <?php echo $menoresInput == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                             
                            </div> 
                        </div> 
                        
                        <div class="row">
                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad_1">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select name="edad[]" class="form-control">
                                        <option value="seleccione" disabled selected>Seleccione</option>
                                        <?php for($i=0; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>

                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad_2">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select name="edad[]" class="form-control">
                                        <option value="seleccione" disabled selected>Seleccione</option>
                                        <?php for($i=0; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>
                            
                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad_3">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select name="edad[]" class="form-control">
                                        <option value="seleccione" disabled selected>Seleccione</option>
                                        <?php for($i=0; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>
                            
                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad_4">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select name="edad[]" class="form-control">
                                        <option value="seleccione" disabled selected>Seleccione</option>
                                        <?php for($i=0; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>                            

                            <div class="col-12 col-sm-3 cajamotor">
                                <label for="">&nbsp;</label>
                                <button for="formbuscador" id="btnBuscahotel" onclick="buscarHotel()" class="btn btn-primary w-100 btnMotor" type="button">
                                    BUSCAR HOTELES
                                </button>                                                    
                            </div>                            
                        </div>
                    </form>               
                    <!-- TERMINA MOTOR -->
                </div>
            </div>            
            <!-- TERMINA MOTOR -->

            <?php 
                $registro = 1;
                foreach($hoteles as $hotel){ 
                    
                    $idhotel = $hotel["id"];   
                    $price_night = $hotel["rates"][0]["daily_prices"];
                    $room_name = $hotel["rates"][0]["room_name"]; 
                    $allotment = $hotel["rates"][0]["allotment"];    
                    $amenities = $hotel["rates"][0]["amenities_data"];                                  
                    
                    $total = 0;
                    foreach($price_night as $price){
                        $total = $total + $price;
                    }
    
                    $total = $fn->tarifaPublicaAgencias($total);   
                    $totalPublico = $total / (1 - ($markup / 100));
    
                        $imgLink="img/fotolocal.jpg";
                        $clave = array_search($idhotel, array_column($hotelsBDs, 'idHotel'));  
                        $claveAds = array_search($hotel["rates"][0]["meal"], array_column($hotelAds, 'name')); 

                        switch ($hotel["rates"][0]["meal"]) {
                            case 'breakfast-for-2':
                                $planHospedaje = 'breakfast';
                                break;
                            default:
                                $planHospedaje = $hotel["rates"][0]["meal"];
                        }                                           

                        if($clave != ''){
                            $hotelName = $hotelsBDs[$clave]["hotelName"];
                            $meal      = $hotelAds[$claveAds]["es"];

                            $imagenes  = json_decode($hotelsBDs[$clave]["images"]);
                            if(is_array($imagenes)){
                                if(count($imagenes) > 0){
                                    $imagen = $imagenes[0];   
                                    $imgLink = str_replace("{size}", "1024x768", $imagen); 
                                }
                            }
                                
                            $filters = json_decode($hotelsBDs[$clave]["serp_filters"]);
                            if(is_array($filters)){
                                $serp_filters = implode(" ", $filters);
                            }else {
                                $serp_filters = '';
                            }
                            
                            $direccion    = $hotelsBDs[$clave]["address"];
                            $checkin      = $hotelsBDs[$clave]["check_in_time"];
                            $checkout     = $hotelsBDs[$clave]["check_out_times"];
                            $stars        = $hotelsBDs[$clave]["star_rating"];
                            $kind         = $hotelsBDs[$clave]["kind"];                            
                        }else{
                            $hotelName    = $idhotel;
                            $direccion    = 'Esta propiedad aun no se carga en el sistema';
                            $checkin      = '';
                            $checkout     = ''; 
                            $stars        = 1;   
                            $kind         = '';                                               
                            $serp_filters = '';
                        }                        
                        
                        $link  = $idhotel; 
                        $link .= "/".$checkinDate;
                        $link .= "/".$checkoutDate;
                        $link .= "/".$adultos;
                        $link .= "/".$menoresTxt;
                        $link .= "/".$totalPublico;
                        $link .= "/".$residency;
                        $link .= "/".$markup."/";            
            
            ?>
			<div class="row strip_list wow fadeIn animated" data-wow-delay="0.2s">
				<div class="col-md-5">
					<div class="img_wrapper">
						<!-- <div class="ribbon">
							<span>Popular</span>
						</div> -->
						<div class="price_grid">
                            <sup>$</sup><?php echo number_format($totalPublico, 2, '.', ','); ?> <small><?php echo $monedaSeleccionada; ?></small>
						</div>
						<div class="img_container">
							<a href="hotel/<?php echo $fn->stringToUrl($hotelName)."/".$link; ?>">
								<img src="<?php echo $imgLink ?>" width="800" height="533" class="img-responsive img-responsive-height" alt="<?php echo $hotelName; ?>">
								<div class="short_info">
                                    <em>
                                        <?php if($stars > 1){ ?>
                                            <i class="<?php echo $stars >= 1 ? 'fas' : 'far'; ?> fa-star"></i>
                                            <i class="<?php echo $stars >= 2 ? 'fas' : 'far'; ?> fa-star"></i>
                                            <i class="<?php echo $stars >= 3 ? 'fas' : 'far'; ?> fa-star"></i>
                                            <i class="<?php echo $stars >= 4 ? 'fas' : 'far'; ?> fa-star"></i>
                                            <i class="<?php echo $stars >= 5 ? 'fas' : 'far'; ?> fa-star"></i>
                                        <?php }else{ ?>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="<?php echo $stars >= 4 ? 'fas' : 'far'; ?> fa-star"></i>
                                            <i class="<?php echo $stars >= 5 ? 'fas' : 'far'; ?> fa-star"></i>
                                        <?php } ?>
                                    </em>
									<div class="score_wp">Tripadvisor
										<div class="score">8.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>
				<div class="col-md-7">
					<h3 class="mt-0"><?php echo $hotelName; ?></h3>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $direccion; ?></p>

                    <h5><?php echo $room_name; ?></h5>
                    <p>
                        <?php echo $meal; ?> <br>
                        <?php echo $allotment > 1 ? $allotment." habitaciones disponibles" : "1 habitación disponible" ?>
                    </p>
                    
                    <h5>Checkin: <?php echo $checkin; ?> | Checkout <?php echo $checkout; ?></h5>               
					<p>
						<a href="hotel/<?php echo $fn->stringToUrl($hotelName)."/".$link; ?>" class="btn_1">Ver habitaciones</a>
					</p>
				</div>
			</div>

            <?php } ?>

			<!-- End strip list -->

			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div class="container margin_60">
		<div class="banner">
			<h3>Reserva con anticipación y paga poco a poco tu hospedaje. Para más información contáctanos</h3>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/jquery.selectbox-0.2.js"></script>
    <script>
        $(document).ready(function(){    
            
            // $checkinDate             = filter_input(INPUT_POST, "checkin", FILTER_DEFAULT);
            // $checkoutDate            = filter_input(INPUT_POST, "checkout", FILTER_DEFAULT);

            let today  = moment().add(2, 'days').format("YYYY/MM/DD")
            let maxday = moment().add(730, 'days').format("YYYY/MM/DD")
            $('#fechas').daterangepicker({
                autoApply: true,
                opens: 'left',
                minDate: today,
                maxDate: maxday,
                maxSpan:{
                    "days":30
                },
                startDate: moment('<?php echo $checkinDate; ?>').format("YYYY/MM/DD"),
                endDate: moment('<?php echo $checkoutDate; ?>').format("YYYY/MM/DD"),
                locale: {
                    applyLabel: "Aplicar",
                    format: 'YYYY-MM-DD'
                }                
            }, function(start, end, label) {
                $("#date_start").val(start.format('YYYY-MM-DD'));
                $("#date_end").val(end.format('YYYY-MM-DD'));
            });            

            $('#fechas').on('apply.daterangepicker', function(ev, picker) {
                console.log(picker.startDate.format('YYYY/MM/DD'));
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('#fechas').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });  

            $(".selectbox").selectbox();

            $('#destino_tours').select2({                
                minimumInputLength: 3,
                dropdownPosition: 'below',
                allowClear: true,
                width: 'resolve',
                placeholder: 'Escribe un destino ó un hotel',
                language: "es",                          
                ajax: {
                    url: 'destination-search',
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

        function buscarHotel(){
            // formbuscador
            if($("#formbuscador").submit()){
                $("#btnBuscahotel").html("BUSCANDO HOTELES....");
            }
            
        }
    </script>    

</body>

</html>
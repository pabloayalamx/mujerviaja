<!DOCTYPE html>
<?php
include("templates/language.php");
include("class/allclass.php");

$idRegion                = filter_input(INPUT_GET, "destino_tours", FILTER_DEFAULT);
$nombreDestino           = filter_input(INPUT_GET, "nombreDestino", FILTER_DEFAULT);
$adultos                 = intval(filter_input(INPUT_GET, "adultos", FILTER_SANITIZE_NUMBER_INT));
$menoresInput            = filter_input(INPUT_GET, "menores", FILTER_SANITIZE_NUMBER_INT); //Sirve para contabilizar la cantidad de huespedes 
$menoresTxt              = $menoresInput > 0 ? implode(",", $_GET["edad"]) : '0';

$checkinDate             = filter_input(INPUT_GET, "checkin", FILTER_DEFAULT);
$checkoutDate            = filter_input(INPUT_GET, "checkout", FILTER_DEFAULT);
// echo "checkin: ".$checkinDate." - checkout: ".$checkoutDate;
$residency               = "MX";
$currency                = $monedaSeleccionada;
$language                = "es";

if (isset($_GET["edad"])) {
    foreach ($_GET["edad"] as $i => $edad) {
        $menoresarray[$i] = intval($edad);
    }
} else {
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

if (!is_numeric($idRegion)) {
    $link = 'hotel/' . $fn->stringToUrl($nombreDestino);
    $link .= "/" . $idRegion;
    $link .= "/" . $checkinDate;
    $link .= "/" . $checkoutDate;
    $link .= "/" . $adultos;
    $link .= "/" . $menoresTxt;
    $link .= "/0";
    $link .= "/" . $residency;
    $link .= "/" . $myWebSite["comision_hoteleria"];
    header('Location: ' . $link);
}

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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap4utilities.css" />
    <style>
        .active-nav {
            transform: translateX(0%) !important;
        }

        @media screen and (max-width: 768px) {
            #filtros-nav {
                top: 0;
                left: 0;
                height: 100%;
                position: fixed !important;
                transform: translateX(-100%);
                z-index: 5000;
                overflow-x: hidden;
                transition: 0.5s;
            }

            #close-nav {
                display: block !important;
            }

            .ui-autocomplete {
                z-index: 8000;
            }
        }
    </style>
</head>

<body>
    <script>
        var nombresHotels = [];
    </script>
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
                    <form id="formbuscador" action="hotel-list" method="get" class="container-fluid">
                        <div class="row">
                            <h3 class="tituloMotor">¿A dónde quieres ir?</h3>
                            <div class="col-12 col-sm-5 text-left cajamotor">
                                <div class="form-group">
                                    <input type="hidden" name="nombreDestino" id="nombreDestino" value="">
                                    <input type="hidden" name="lang" id="lang" value="es">
                                    <label for="">Busca tu destino</label>
                                    <select name="destino_tours" id="destino_tours" class="form-control" required style="width: 100%;">
                                        <option value="<?php echo $_GET["destino_tours"]; ?>"><?php echo $_GET["nombreDestino"]; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-3 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Checkin / Checkout</label>
                                    <input type="hidden" name="checkin" id="date_start" value="">
                                    <input type="hidden" name="checkout" id="date_end" value="">
                                    <input type="text" id="fechas" name="fechas" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-sm-2 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Adultos</label>
                                    <select name="adultos" id="adultos" class="form-control" required>
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php echo $adultos == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-2 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Menores</label>
                                    <select name="menores" id="menores" class="form-control" onchange="menoresEdadesPedrito(value)">
                                        <?php for ($i = 0; $i <= 4; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php echo $menoresInput == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad1">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for ($i = 1; $i <= 16; $i++) { ?>
                                            <?php $supercomparativa =  $menoresarray[0] ?? null ?>
                                            <option value="<?php echo $i; ?>" <?php echo $supercomparativa == $i ? "selected" : "" ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad2">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for ($i = 1; $i <= 16; $i++) { ?>
                                            <?php $supercomparativa =  $menoresarray[1] ?? null ?>
                                            <option value="<?php echo $i; ?>" <?php echo $supercomparativa == $i ? "selected" : "" ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad3">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for ($i = 1; $i <= 16; $i++) { ?>
                                            <?php $supercomparativa =  $menoresarray[2] ?? null ?>
                                            <option value="<?php echo $i; ?>" <?php echo $supercomparativa == $i ? "selected" : "" ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad4">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for ($i = 1; $i <= 16; $i++) { ?>
                                            <?php $supercomparativa =  $menoresarray[3] ?? null ?>
                                            <option value="<?php echo $i; ?>" <?php echo $supercomparativa == $i ? "selected" : "" ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-3 cajamotor">
                                <label for="">&nbsp;</label>
                                <button id="btnBuscahotel" class="btn btn-primary w-100 btnMotor" type="submit">
                                    BUSCAR HOTELES
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- TERMINA MOTOR -->
                </div>
            </div>
            <!-- TERMINA MOTOR -->

            <div class="row">
                <button onclick="openCloseNav()" type="button" class="btn btn-primary p-fixed d-block d-md-none" style="position: fixed; bottom: 106px; right: -26px; transform: translateX(-50%); z-index: 5001; border-radius: 100%; padding: 25px 15px;">
                    Filtros
                </button>
                <div id="filtros-nav" class="col-sm-4 borde-pedrito" style="background-color: white;">

                <div class="panel panel-default">
                            <div class="panel-body">
                            <div id="hotelesEncontrados" data-total="<?php echo count($hoteles); ?>"><?php echo count($hoteles); ?> hoteles encontrados</div>
                            </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Búsqueda de hoteles</div>
                        <div class="panel-body">
                            <input class="form-control" style="border: 1px solid #b4b4b4 !important;" type="text" name="nombreHotel" id="nombreHotel" onkeyup="filtrPorNombre(value)">
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Popularidad</div>
                        <div class="panel-body">
                            <select id="popularidad" class="form-control niceSelect estilo-ordenamiento">
                                <option data-sort="length:asc">Popularidad</option>
                                <option data-sort="price:asc">Precio (bajo a alto)</option>
                                <option data-sort="price:desc">Precio (alto a bajo)</option>
                            </select>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">Estrellas</div>
                        <div class="panel-body">
                            <span id="cantEstrellas">


                            </span>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">Alimentos</div>
                        <div class="panel-body">
                            <span id="planAlimentos">


                            </span>
                        </div>
                    </div>

                </div>
                <div class="col-sm-8">

                    <div class="displayflex-popularidad-pedrito">

                        <?php
                        $registro = 1;
                        $arrayMeals = [];
                        $arrayStars = [];
                        foreach ($hoteles as $conteo => $hotel) {

                            $idhotel = $hotel["id"];
                            $price_night = $hotel["rates"][0]["daily_prices"];
                            $room_name = $hotel["rates"][0]["room_name"];
                            $allotment = $hotel["rates"][0]["allotment"];
                            $amenities = $hotel["rates"][0]["amenities_data"];

                            $total = 0;
                            foreach ($price_night as $price) {
                                $total = $total + $price;
                            }

                            $total = $fn->tarifaPublicaAgencias($total);
                            $totalPublico = $total / (1 - ($markup / 100));

                            $imgLink = "img/fotolocal.jpg";
                            $clave = array_search($idhotel, array_column($hotelsBDs, 'idHotel'));
                            $claveAds = array_search($hotel["rates"][0]["meal"], array_column($hotelAds, 'name'));

                            switch ($hotel["rates"][0]["meal"]) {
                                case 'breakfast-for-2':
                                    $planHospedaje = 'breakfast';
                                    break;
                                default:
                                    $planHospedaje = $hotel["rates"][0]["meal"];
                            }

                            if ($clave != '') {
                                $hotelName = $hotelsBDs[$clave]["hotelName"];
                                $meal      = $hotelAds[$claveAds]["es"];

                                $arrayMeals[] = $meal;

                                $imagenes  = json_decode($hotelsBDs[$clave]["images"]);
                                if (is_array($imagenes)) {
                                    if (count($imagenes) > 0) {
                                        $imagen = $imagenes[0];
                                        $imgLink = str_replace("{size}", "240x240", $imagen);
                                    }
                                }

                                $filters = json_decode($hotelsBDs[$clave]["serp_filters"]);
                                if (is_array($filters)) {
                                    $serp_filters = implode(" ", $filters);
                                } else {
                                    $serp_filters = '';
                                }

                                $direccion    = $hotelsBDs[$clave]["address"];
                                $checkin      = $hotelsBDs[$clave]["check_in_time"];
                                $checkout     = $hotelsBDs[$clave]["check_out_times"];
                                $stars        = $hotelsBDs[$clave]["star_rating"];
                                if ($stars == 0) {
                                    $stars = 1;
                                }
                                $kind         = $hotelsBDs[$clave]["kind"];
                            } else {
                                $hotelName    = $idhotel;
                                $direccion    = 'Esta propiedad aun no se carga en el sistema';
                                $checkin      = '';
                                $checkout     = '';
                                $stars        = 1;
                                $kind         = '';
                                $serp_filters = '';
                            }

                            $arrayStars[] = $stars;

                            $link  = $idhotel;
                            $link .= "/" . $checkinDate;
                            $link .= "/" . $checkoutDate;
                            $link .= "/" . $adultos;
                            $link .= "/" . $menoresTxt;
                            $link .= "/" . $totalPublico;
                            $link .= "/" . $residency;
                            $link .= "/" . $markup . "/";

                        ?>

                            <script>
                                nombresHotels.push({
                                    "value": "<?php echo $hotelName; ?>",
                                    "label": "<?php echo $hotelName; ?>",
                                    "buscar": "<?php echo $idhotel; ?>"
                                });
                            </script>


                            <div class="row strip_list  filaHotel stars_<?php echo $stars; ?> meal_<?php echo $fn->reemplaza_espacios($meal); ?> <?php echo $idhotel; ?>" data-length="<?php echo $conteo; ?>" data-price="<?php echo ceil($totalPublico); ?>"" >
                            <div class=" col-md-5">
                                <div class="img_wrapper">
                                    <!-- <div class="ribbon">
							<span>Popular</span>
						</div> -->
                                    <div class="price_grid">
                                        <sup>$</sup><?php echo number_format($totalPublico, 2, '.', ','); ?> <small><?php echo $monedaSeleccionada; ?></small>
                                    </div>
                                    <div class="img_container">
                                        <a href="hotel/<?php echo $fn->stringToUrl($hotelName) . "/" . $link; ?>">
                                            <img src="<?php echo $imgLink ?>" width="800" height="533" class="img-responsive img-responsive-height" alt="<?php echo $hotelName; ?>">
                                            <div class="short_info">
                                                <em>

                                                    <i class="<?php echo $stars >= 1 ? 'fas' : 'far'; ?> fa-star"></i>
                                                    <i class="<?php echo $stars >= 2 ? 'fas' : 'far'; ?> fa-star"></i>
                                                    <i class="<?php echo $stars >= 3 ? 'fas' : 'far'; ?> fa-star"></i>
                                                    <i class="<?php echo $stars >= 4 ? 'fas' : 'far'; ?> fa-star"></i>
                                                    <i class="<?php echo $stars >= 5 ? 'fas' : 'far'; ?> fa-star"></i>

                                                </em>
                                                <!-- <div class="score_wp">Tripadvisor
                                                    <div class="score">8.5</div>
                                                </div> -->
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
                                    <?php echo $allotment > 1 ? $allotment . " habitaciones disponibles" : "1 habitación disponible" ?>
                                </p>

                                <h5>Checkin: <?php echo $checkin; ?> | Checkout <?php echo $checkout; ?></h5>
                                <p>
                                    <a href="hotel/<?php echo $fn->stringToUrl($hotelName) . "/" . $link; ?>" class="btn_1">Ver habitaciones</a>
                                </p>
                            </div>
                    </div>

                <?php } ?>

                </div>

            </div>
        </div>

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <!-- SPECIFIC SCRIPTS -->
    <script src="js/jquery.selectbox-0.2.js"></script>
    <script>
        $(document).ready(function() {

            let today = moment().add(5, 'days').format("YYYY/MM/DD")
            let maxday = moment().add(730, 'days').format("YYYY/MM/DD")


            $("#date_start").val('<?php echo $checkinDate ?>');
            $("#date_end").val('<?php echo $checkoutDate ?>');
            $("#nombreDestino").val('<?php echo $_GET["nombreDestino"]; ?>');
            menoresEdadesPedrito(<?php echo count($menoresarray) ?>)


            $('#fechas').daterangepicker({
                autoApply: true,
                opens: 'left',
                minDate: today,
                maxDate: maxday,
                maxSpan: {
                    "days": 30
                },
                startDate: '<?php echo $checkinDate ?>',
                endDate: '<?php echo $checkoutDate ?>',
                locale: {
                    applyLabel: "Aplicar",
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end, label) {
                $("#date_start").val(start.format('YYYY-MM-DD'));
                $("#date_end").val(end.format('YYYY-MM-DD'));
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
                    data: function(params) {
                        var query = {
                            search: params.term
                        }
                        return query;

                    }
                },

            });

            $('#destino_tours').on('select2:select', function(e) {
                var data = e.params.data;
                $("#nombreDestino").val(data.text);
            });

            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        });


        function menoresEdadesPedrito(menores) {
            for (i = 1; i <= 4; i++) {
                if (i <= menores) {
                    $("#edad" + i).show();
                    $(`#edad${i} select`).removeAttr('disabled')
                } else {
                    $("#edad" + i).hide();
                    $(`#edad${i} select`).prop("disabled", true);
                }
            }
        }

        var headerOpen = false;
        function openCloseNav() {
            if(headerOpen == false){headerOpen = true;} else {headerOpen = false;}
            if(headerOpen == true){ document.querySelector("#header_1").style.display = 'none'} else {document.querySelector("#header_1").style.display = 'block'}
            document.getElementById("filtros-nav").classList.toggle("active-nav");
        }
        $("#filtros-nav").add(document).scroll(function(){
      document.querySelector("#ui-id-1").style.display = "none"
    });
    </script>


    <script>
        <?php
        asort($arrayStars); //Ordena el arreglo de estrellas
        $filtrosMeals = array_count_values($arrayMeals);
        //El proceso de ordenamiento se realiza a la inversa
        $filtrosStars = array_count_values($arrayStars);
        arsort($filtrosMeals);
        ?>
            (function($) {
                "use strict";
                $.fn.numericFlexboxSorting = function(options) {
                    const settings = $.extend({
                        elToSort: ".filaHotel"
                    }, options);

                    const $select = this;
                    const ascOrder = (a, b) => a - b;
                    const descOrder = (a, b) => b - a;

                    $select.on("change", () => {
                        const selectedOption = $select.find("option:selected").attr("data-sort"); //tipo de orden
                        // console.log("tipo de orden enviado: "+selectedOption); (Ej: price:asc)
                        sortColumns(settings.elToSort, selectedOption);
                    });

                    function sortColumns(el, opt) {
                        //Filas que se afectaran, tipo de orden
                        const optArr = opt.split(":");
                        const attr = "data-" + opt.split(":")[0];
                        const sortMethod = (opt.includes("asc")) ? ascOrder : descOrder;
                        const sign = (opt.includes("asc")) ? "" : "-";
                        const sortArray = $(el).map((i, el) => $(el).attr(attr)).sort(sortMethod);
                        // $("#filtroresultados").show();
                        for (let i = 0; i < sortArray.length; i++) {
                            $(el).filter(`[${attr}="${sortArray[i]}"]`).css("order", sign + sortArray[i]);
                        }
                        // const myTimeout = setTimeout(quitarFiltro, 1500);
                    }

                    return $select;
                };
            })(jQuery);

        $(document).ready(function() {

            $("#popularidad").numericFlexboxSorting();

            <?php foreach ($filtrosMeals as $filtroName => $filtroMeal) { ?>
                $("#planAlimentos").append('<li style="margin: 0.5rem"><input class="form-check-input" type="checkbox" value="meal_<?php echo $fn->reemplaza_espacios($filtroName); ?>"> <?php echo $filtroName; ?> <span class="float-end"><?php echo $filtroMeal; ?></span></li>');
            <?php } ?>

            <?php
            foreach ($filtrosStars as $filtroStarCant => $filtroStar) {

                $htmlStars  = $filtroStarCant >= 1 ? '<span class="text-yellow"><i class="fa fa-star"></i>' : '<span class="text-muted"><i class="fa fa-star"></i></span>';
                $htmlStars .= $filtroStarCant >= 2 ? '<span class="text-yellow"><i class="fa fa-star"></i>' : '<span class="text-muted"><i class="fa fa-star"></i></span>';
                $htmlStars .= $filtroStarCant >= 3 ? '<span class="text-yellow"><i class="fa fa-star"></i>' : '<span class="text-muted"><i class="fa fa-star"></i></span>';
                $htmlStars .= $filtroStarCant >= 4 ? '<span class="text-yellow"><i class="fa fa-star"></i>' : '<span class="text-muted"><i class="fa fa-star"></i></span>';
                $htmlStars .= $filtroStarCant >= 5 ? '<span class="text-yellow"><i class="fa fa-star"></i>' : '<span class="text-muted"><i class="fa fa-star"></i></span>';

            ?>
                $("#cantEstrellas").append('<li style="margin: 0.5rem"><input class="form-check-input" type="checkbox" value="stars_<?php echo $filtroStarCant; ?>"> <?php echo $htmlStars; ?> <span class="float-end"><?php echo $filtroStar; ?></span></li>');
            <?php } ?>


            $(".form-check-input").click(function() {
                let filtros = [];
                $(".form-check-input").each(function() {
                    if ($(this).is(':checked')) {
                        let valor = $(this).val();
                        filtros.push(valor);
                    }
                });
                FiltrarResultados(filtros);
            });


            $("#nombreHotel").autocomplete({
                minLength: 3,
                classes: {
                    "ui-autocomplete": "listaHotelNames"
                },
                source: nombresHotels,
                select: function(event, ui) {
                    var label = ui.item.label;
                    var value = ui.item.value;
                    var buscar = ui.item.buscar;
                    filtrarPorHotel(buscar);
                }
            });
        });
        //Funciones de filtros
        function FiltrarResultados(filtros) {
            $("#nombreHotel").val('');
            let hotelesEncontrados = parseInt($("#hotelesEncontrados").data("total"));
            let cfiltros = filtros.length;
            let filtrados = 0;
            if (cfiltros > 0) {
                $(".filaHotel").each(function() {
                    let elem = $(this);
                    var elemento = elem.attr("class");

                    for (i = 0; i < cfiltros; i++) {
                        let filtro = filtros[i];
                        if (elem.hasClass(filtro)) {
                            elem.show();
                            filtrados++;
                            break;
                        } else {
                            elem.hide();
                        }
                    }
                });
                if (filtrados === 1) {
                    $("#hotelesEncontrados").html(filtrados + " hotel filtrado de " + hotelesEncontrados + " hoteles encontrados");
                } else {
                    $("#hotelesEncontrados").html(filtrados + " hoteles filtrados de " + hotelesEncontrados + " hoteles encontrados");
                }

            } else {
                $(".filaHotel").show();
                $("#hotelesEncontrados").html("Se encontraron " + hotelesEncontrados + " hoteles");
            }

        }

        function filtrarPorHotel(hotelName) {
            let hotelesEncontrados = parseInt($("#hotelesEncontrados").data("total"));
            $(".form-check-input").each(function() {
                $(this).prop("checked", false)
            });

            $(".filaHotel").show();
            $(".filaHotel").not('.' + hotelName).hide();

            $("#hotelesEncontrados").html("1 hotel filtrado de " + hotelesEncontrados + " hoteles encontrados");
        }

        function filtrPorNombre(hotel) {
            if (hotel === '') {
                $(".filaHotel").show();
            }
        }
    </script>

</body>

</html>
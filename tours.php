<!DOCTYPE html>
<?php
include("templates/language.php");
include("class/allclass.php");

$idtourArray = explode("_", $_GET["destino_tours"]);
if(count($idtourArray) == 2){
  $link = 'actividad/actividades/'.$idtourArray[0];
  header('Location: '.$link);
}

if (isset($_GET["nombreDestino"])) {
    $form["lang"]     = $_GET["lang"];
    $form["currency"] = $monedaSeleccionada;
    $form["id"]       = $_GET["destino_tours"];
    $form["sandbox"]  = $sandbox;
    $civitatis        = $tours->getActivitiesCivitatis($form);
    $markup           = $civitatis->empresa[0]->comision_tours;
}
?>

<head>
    <title>Descubre los mejores tours para mujeres en todo el mundo</title>
    <meta name="description" content="Tours en todo el mundo para mujeres">
    <meta name="keywords" content="tours para mujeres, actividades turisticas para mujeres">
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
        var nombreTours = [];
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
                <h1>Nuestros tours</h1>
                <p>Estás a unos clics de tener tu mejor aventura en cualquier parte del mundo</p>
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
                <div class="col-12 container-fluid">

                    <!-- INICIA MOTOR -->
                    <div class="row">
                        <h3 class="tituloMotor text-center">¿A dónde quieres ir?</h3>
                        <form id="form-buscar" action="tours" method="GET" class="responsive-motor-tours">
                            <div class="col-12 col-sm-5 text-left cajamotor">
                                <div class="form-group">
                                    <input type="hidden" name="nombreDestino" id="nombreDestino" value="<?php if (isset($_GET["nombreDestino"])) {
                                                                                                            echo $_GET["nombreDestino"];
                                                                                                        } ?>">
                                    <input type="hidden" name="lang" id="lang" value="es">
                                    <select name="destino_tours" id="destino_tours" class="form-control" style="width: 100%;" required>
                                        <?php if (isset($_GET["nombreDestino"])) { ?> <option value="<?php echo $_GET["destino_tours"]; ?>"><?php echo $_GET["nombreDestino"]; ?></option> <?php } ?>
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

            <?php if (isset($_GET["nombreDestino"])) { ?>

                <div class="row">
                    <button onclick="openCloseNav()" type="button" class="btn btn-primary p-fixed d-block d-md-none" style="position: fixed; bottom: 106px; right: -26px; transform: translateX(-50%); z-index: 5001; border-radius: 100%; padding: 25px 15px;">
                        Filtros
                    </button>
                    <div id="filtros-nav" class="col-sm-4 borde-pedrito" style="background-color: white;">

                    <div class="panel panel-default">
                            <div class="panel-body">
                            <div id="toursEncontrados" data-total="<?php echo count($civitatis->actividades); ?>"><?php echo count($civitatis->actividades); ?> actividades encontradas</div>
                            </div>
                    </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Búsqueda de hoteles</div>
                            <div class="panel-body">
                                <input type="text" class="form-control" name="nombreTour" id="nombreTour" onkeyup="filtrPorNombre(value)">
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Popularidad</div>
                            <div class="panel-body">
                                <select id="popularidad" class="form-control niceSelect">
                                    <option disabled>Ordenar por</option>
                                    <option data-sort="length:asc">Popularidad</option>
                                    <option data-sort="price:asc">Precio (bajo a alto)</option>
                                    <option data-sort="price:desc">Precio (alto a bajo)</option>
                                </select>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">Tipo de tour</div>
                            <div class="panel-body">
                                <span id="tipoTour" class="sidebar-category1"></span>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-8">
                        <div class="displayflex-popularidad-pedrito">
                            <?php
                            $arrayTipoTours = [];
                            foreach ($civitatis->actividades as $i => $actividad) {

                                $categoriaTour = $fn->reemplaza_espacios($actividad->category->description);
                                $arrayTipoTours[] = $actividad->category->description;
                            ?>

                                <script>
                                    nombreTours.push({
                                        "value": "<?php echo $actividad->title; ?>",
                                        "label": "<?php echo $actividad->title; ?>",
                                        "buscar": "<?php echo $fn->stringToUrl($actividad->title); ?>"
                                    });
                                </script>

                                <div class="row strip_list filaHotel <?php echo $fn->stringToUrl($categoriaTour); ?> <?php echo $fn->stringToUrl($actividad->title); ?>" data-length="<?php echo $i; ?>" data-price="<?php echo ceil($actividad->minimumPrice); ?>">
                                    <div class="col-md-5">
                                        <div class="img_wrapper">
                                            <!-- <div class="ribbon">
							<span>Popular</span>
						</div> -->
                                            <div class="price_grid">
                                                <sup>$</sup> <?php echo $fn->tarifaPublicaAgenciasTours($actividad->minimumPrice, $markup); ?> <small><?php echo $actividad->currency; ?></small>
                                            </div>
                                            <div class="img_container">
                                                <a href="actividad/<?php echo $fn->stringToUrl($actividad->title) . "/" . $actividad->id; ?>" title="<?php echo $actividad->title; ?>">
                                                    <img src="<?php echo $actividad->photos->gallery[0]->paths->thumbnail; ?>" width="800" height="533" class="img-responsive img-responsive-height" alt="<?php echo $actividad->title; ?>">
                                                    <div class="short_info">
                                                        <?php
                                                        if ($actividad->duration->duration / 60 > 24) {
                                                            $horas = $actividad->duration->duration / 60;
                                                            $dias = $horas / 24;
                                                        ?>
                                                            <em>Duración <?php echo $dias; ?> <?php echo $dias > 1 ? 'días' : 'día'; ?></em>
                                                        <?php } else { ?>
                                                            <em>Duración <?php echo ceil($actividad->duration->duration / 60); ?> <?php echo $actividad->duration->duration / 60 > 1 ? 'Horas' : 'Hora' ?></em>
                                                        <?php } ?>
                                                        <div class="score_wp">

                                                            <?php if ($actividad->score <= 7) {
                                                                echo 'Bueno';
                                                            } else if ($actividad->score >= 8) {
                                                                echo 'Excelente';
                                                            } ?>

                                                            <div class="score"><?php echo $actividad->score < 5 ? '7.5' : $actividad->score; ?></div>
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
                                            <a href="actividad/<?php echo $fn->stringToUrl($actividad->title) . "/" . $actividad->id; ?>" title="<?php echo $actividad->title; ?>" class="btn_1">Ver tour</a>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <!-- End strip list -->

            <?php  } ?>

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        var headerOpen = false;

        function openCloseNav() {
            if (headerOpen == false) {
                headerOpen = true;
            } else {
                headerOpen = false;
            }
            if (headerOpen == true) {
                document.querySelector("#header_1").style.display = 'none'
            } else {
                document.querySelector("#header_1").style.display = 'block'
            }
            document.getElementById("filtros-nav").classList.toggle("active-nav");
        }
        $("#filtros-nav").add(document).scroll(function(){
      document.querySelector("#ui-id-1").style.display = "none"
    });
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
                    for (let i = 0; i < sortArray.length; i++) {
                        $(el).filter(`[${attr}="${sortArray[i]}"]`).css("order", sign + sortArray[i]);
                    }
                }

                return $select;
            };
        })(jQuery);

        $(document).ready(function() {

            // inicia filtro tours
            $("#popularidad").numericFlexboxSorting();

            <?php
            if (isset($_GET["nombreDestino"])) {
                asort($arrayTipoTours);
                $filtrosTipoTours = array_count_values($arrayTipoTours);
            }
            ?>
            <?php
            if (isset($_GET["nombreDestino"])) {
                foreach ($filtrosTipoTours as $filtroTourName => $filtroTourCount) { ?>
                    $("#tipoTour").append('<li><input class="form-check-input" type="checkbox" value="<?php echo $fn->stringToUrl($filtroTourName); ?>"> <?php echo $filtroTourName; ?> <span class="float-end"><?php echo $filtroTourCount; ?></span></li>');
                <?php } ?>
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

            $("#nombreTour").autocomplete({
                minLength: 3,
                classes: {
                    "ui-autocomplete": "listaHotelNames"
                },
                source: nombreTours,
                select: function(event, ui) {
                    // $("#filtros-nav").removeClass("active-nav");
                    var label = ui.item.label;
                    var value = ui.item.value;
                    var buscar = ui.item.buscar;
                    filtrarPorTour(buscar);
                }
            });

            // termina filtro tours

            $('#formbuscador').submit(function(e) {
                $("#mensajeBuscando").show();
            });

            $('#formbuscadorTours').submit(function(e) {
                $("#mensajeBuscando").show();
            });

            let today = moment().add(2, 'days').format("YYYY/MM/DD")
            let maxday = moment().add(730, 'days').format("YYYY/MM/DD")
            $('#fechas').daterangepicker({
                autoApply: true,
                opens: 'left',
                minDate: today,
                maxDate: maxday,
                maxSpan: {
                    "days": 30
                },
                startDate: moment().add(1, 'days').format("YYYY/MM/DD"),
                endDate: moment().add(2, 'days').format("YYYY/MM/DD"),
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

            $("#destino").autocomplete({
                source: function(request, response) {
                    $("#buscaDestino").show();
                    $.ajax({
                        dataType: "json",
                        type: 'get',
                        data: {
                            search: request.term,
                        },
                        url: 'destination-search',
                        success: function(data) {
                            $('input.suggest-user').removeClass('ui-autocomplete-loading');
                            $("#buscaDestino").hide();

                            response($.map(data, function(item) {
                                return {
                                    label: item.text,
                                    value: item.text,
                                    id: item.id
                                };
                            }));
                        },
                        error: function(data) {
                            $('input.suggest-user').removeClass('ui-autocomplete-loading');
                        }
                    });
                },
                minLength: 3,
                open: function() {
                    $("#loadHotelsNames").hide();
                },
                close: function() {},
                focus: function(event, ui) {},
                search: function(event, ui) {
                    $("#loadHotelsNames").show();
                },
                select: function(event, ui) {
                    $("#nombreDestinoHotelero").val(ui.item.label);
                    $("#destinoHotelero").val(ui.item.id);
                }
            });


            $("#destino_tours").autocomplete({
                source: function(request, response) {
                    $("#buscaDestinotour").show();
                    $.ajax({
                        dataType: "json",
                        type: 'get',
                        data: {
                            search: request.term,
                        },
                        url: 'destination-tours',
                        success: function(data) {
                            $('input.suggest-user').removeClass('ui-autocomplete-loading');
                            $("#buscaDestinotour").hide();

                            response($.map(data, function(item) {
                                return {
                                    label: item.text,
                                    value: item.text,
                                    id: item.id
                                };
                            }));
                        },
                        error: function(data) {
                            $('input.suggest-user').removeClass('ui-autocomplete-loading');
                        }
                    });
                },
                minLength: 3,
                open: function() {
                    $("#loadToursNames").hide();
                },
                search: function(event, ui) {
                    $("#loadToursNames").show();
                },
                close: function() {},
                focus: function(event, ui) {},
                select: function(event, ui) {
                    $("#nombreDestinoTour").val(ui.item.label);
                    $("#idDestinoTour").val(ui.item.id);
                }
            });
        });

        function filtrarPorTour(tourName) {
            let toursEncontrados = parseInt($("#toursEncontrados").data("total"));
            $(".form-check-input").each(function() {
                $(this).prop("checked", false)
            });

            $(".filaHotel").show();
            $(".filaHotel").not('.' + tourName).hide();

            $("#toursEncontrados").html("1 tour filtrado de " + toursEncontrados + " tours encontrados");
        }

        function filtrPorNombre(tour) {
            if (tour === '') {
                $(".filaHotel").show();
            }
        }

        function FiltrarResultados(filtros) {
            $("#nombreTour").val('');
            let toursEncontrados = parseInt($("#toursEncontrados").data("total"));
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
                    $("#toursEncontrados").html(filtrados + " tour filtrado de " + toursEncontrados + " tours encontrados");
                } else {
                    $("#toursEncontrados").html(filtrados + " tours filtrados de " + toursEncontrados + " tours encontrados");
                }

            } else {
                $(".filaHotel").show();
                $("#toursEncontrados").html("Se encontraron " + toursEncontrados + " tours");
            }

        }
    </script>


    <!-- SPECIFIC SCRIPTS -->
    <script src="js/jquery.selectbox-0.2.js"></script>
    <script>
        $(document).ready(function() {

            $(".selectbox").selectbox();

            $('#destino_tours').select2({
                minimumInputLength: 3,
                dropdownPosition: 'below',
                allowClear: true,
                width: 'resolve',
                placeholder: 'Escribe un destino',
                language: "es",
                templateResult: formatState,
                ajax: {
                    url: 'destination-tours',
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

            function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var baseUrl = "/user/pages/images/flags";
        var $state = $(
            '<span><i class="fa ' + state.icono + '"></i> ' + state.text + '</span>'
        );
        return $state;
    };

            $('#destino_tours').on('select2:select', function(e) {
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
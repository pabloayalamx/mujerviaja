/* <![CDATA[ */

// Jquery validate form booking form inner page
jQuery(document).ready(function(){

	$('#check_avail').submit(function(){
	'use strict';
		var action = $(this).attr('action');

		$("#message-booking").slideUp(750,function() {
			$('#message-booking').hide();

			$('#submit-booking')
				.after('<i class="icon-spin4 animate-spin loader"></i>')
				.attr('disabled','disabled');
				
			$.post(action, {
				adultos: $('#adultos').val(),
				menores: $('#menores').val(),
				infantes: $('#infantes').val(),
				fecha_viaje_input: $('#fecha_viaje_input').val(),
				fecha_viaje: $('#fecha_viaje').val(),
				name_lastname_booking: $('#name_lastname_booking').val(),
				verify_booking: $("#verify_booking").val(),
				email_booking: $('#email_booking').val(),
				telephone_booking: $('#telephone_booking').val(),
				total: $('#total').val(),
				tour_name: $('#tour_name').val()
			},
				function(data){
					document.getElementById('message-booking').innerHTML = data;
					$('#message-booking').slideDown('slow');
					$('#check_avail .loader').fadeOut('slow',function(){$(this).remove()});
					$('#submit-booking').removeAttr('disabled');

					if(data.match('success') != null) {
						$('#check_avail').slideUp('slow', function(){
							$("#frmReserva").submit();
						});
					}else{
						document.getElementById('message-booking').innerHTML = data;
					}
					

				}
			);

		});

		return false;

	});
});

/// Jquery validate newsletter
jQuery(document).ready(function(){

	$('#newsletter_2').submit(function(){

		var action = $(this).attr('action');

		$("#message-newsletter_2").slideUp(750,function() {
		$('#message-newsletter_2').hide();
		
		$('#submit-newsletter_2')
			.after('<i class="icon-spin4 animate-spin loader"></i>')
			.attr('disabled','disabled');

		$.post(action, {
			email_newsletter_2: $('#email_newsletter_2').val()
		},
			function(data){
				document.getElementById('message-newsletter_2').innerHTML = data;
				$('#message-newsletter_2').slideDown('slow');
				$('#newsletter_2 .loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit-newsletter_2').removeAttr('disabled');
				if(data.match('success') != null) $('#newsletter_2').slideUp('slow');

			}
		);

		});

		return false;

	});

});
// Jquery validate form contact
jQuery(document).ready(function(){

	$('#contactformasdasdasd').submit(function(){

		var action = $(this).attr('action');

		$("#message-contact").slideUp(750,function() {
		$('#message-contact').hide();

 		$('#submit-contact')
		.after('<i class="icon-spin4 animate-spin loader"></i>')
		.attr('disabled','disabled');

		$.ajax({
			data: {
				"name_contact": $('#name_contact').val(),
				"lastname_contact": $('#lastname_contact').val(),
				"email_contact": $('#email_contact').val(),
				"phone_contact": $('#phone_contact').val(),
				"message_contact": $('#message_contact').val(),
				"verify_contact": $('#verify_contact').val(),
				"email_afiliado": $('#email_afiliado').val(),
				"nombre_afiliado": $('#nombre_afiliado').val()				
			},
			type: "GET",
			dataType: "json",
			url: "assets/contact.php",
		})
		.done(function(response) {
			if(response === 'error'){
				alert("aqui");
				$("i.icon-spin4").hide()
				$("#message-contact").html("Ha ocurrido un error, inténtelo de nuevo").show();

			}else{
				alert("aqui 2");
				$("#parte1").addClass("d-none");
				$("#parte2").removeClass("d-none").html(data);
			}
		})
		.fail(function() {
	
		}); 			
			
		});
		return false;
	});
});


/// Jquery validate review
jQuery(document).ready(function(){

	$('#review').submit(function(){
		var action = $(this).attr('action');

		$("#message-review").slideUp(750,function() {
		$('#message-review').hide();
		
		$('#submit-review')
			.after('<i class="icon-spin4 animate-spin loader"></i>')
			.attr('disabled','disabled');

		$.post(action, {
			tour_name_review: $('#tour_name_review').val(),
			name_review: $('#name_review').val(),
			lastname_review: $('#lastname_review').val(),
			email_review: $('#email_review').val(),
			rating_review: $('#rating_review').val(),
			review_text: $('#review_text').val(),
			verify_review: $('#verify_review').val(),
			email_afiliado: $('#email_afiliado').val(),
			nombre_afiliado: $('#nombre_afiliado').val()			
		},
		
			function(data){
				document.getElementById('message-review').innerHTML = data;
				$('#message-review').slideDown('slow');
				$('#review .loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit-review').removeAttr('disabled');
				if(data.match('success') != null) $('#review').slideUp('slow');

			}
		);

		});

		return false;

	});

});
  /* ]]> */



/**
 * Validación de formularios con AJAX
 */

$(function(){
	$('#btn-ajax').click(function () { 
	   var url = 'mail/formulario-contacto.php';

	   $.ajax({
		   type: "POST",
		   url: url,
		   data: $('#contact-form').serialize(),
		   success: function (data) {
			   $('#nombre-status').html('');
			   $('#email-status').html('');
			   $('#telefono-status').html('');
			   $('#estado-status').html('');
			   $('#ciudad-status').html('');
			   $('#presupuesto-status').html('');
			   $('#terreno-status').html('');
			   $('#camp1-status').html('');
			   $('#camp2-status').html('');
			   $('#camp3-status').html('');
			   $('#interest-status').html('');
			   $('#mensaje-status').html('');
			   $('#terms-status').html('');
			   $('#mensajeErr-Status').html(data);//muestra los datos del script de PHP
		   }
	   });

	   return false;
	});
});

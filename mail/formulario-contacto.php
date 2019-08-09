<?php
//perla.holguin@3e-digital.com

if(isset($_POST)){
		$name = htmlspecialchars($_POST['c_name']);
		$email = htmlspecialchars($_POST['c_email']);
		$phone = htmlspecialchars($_POST['c_phone']);
		$state = htmlspecialchars($_POST['c_state']);
		$city = htmlspecialchars($_POST['c_city']);
		$budget = htmlspecialchars($_POST['c_budget']);
		$radioValue = htmlspecialchars($_POST['radioValue']);
		$camp1 = htmlspecialchars($_POST['c_camp1']);
		$camp2 = htmlspecialchars($_POST['c_camp2']);
		$camp3 = htmlspecialchars($_POST['c_camp3']);
		$radioValue2 = htmlspecialchars($_POST['radioValue2']);
		$message = htmlspecialchars($_POST['c_message']);

	$error = "faltan_valores";

	if ($name && $email && $phone && $state && $city && $budget
		&& $radioValue && $camp1 && $camp2 && $camp3 && $radioValue2 && $message
	) {
		$error = "ok";
		if (!is_int($name) || !is_numeric($name) && !empty($name) && strlen($name) > 2 && strlen($name) < 100) {
			$validate_name = true;
		} else {
			$validate_name = false;
			$error = "nombre";
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 2 && strlen($email) < 150 && !empty($email)) {
			$validate_email = true;
		} else {
			$validate_email = false;
			$error = "email";
		}

		if($phone != "" && preg_match("/^[0-9]+$/", $phone)){
			$validate_phone = true;
		}else{
			$validate_phone = false;
			$error = "telefono";
		}

		if (!is_int($state) || !is_numeric($state) && !empty($state) && strlen($state) > 2 && strlen($state) < 100) {
			$validate_state = true;
		} else {
			$validate_state = false;
			$error = "empresa";
		}

		if (!is_int($giroEmpresarial) || !is_numeric($giroEmpresarial) && !empty($giroEmpresarial) && strlen($giroEmpresarial) > 2 && strlen($giroEmpresarial) < 100) {
			$validate_giro = true;
		} else {
			$validate_giro = false;
			$error = "giro";
		}

		if (!is_int($calle) || !is_numeric($calle) && !empty($calle) && strlen($calle) > 2 && strlen($calle) < 100) {
			$validate_calle = true;
		} else {
			$validate_calle = false;
			$error = "calle";
		}

		if($ext != "" && preg_match("/^[0-9]+$/", $ext)){
			$validate_ext = true;
		}else{
			$validate_ext = false;
			$error = "ext";
		}

		if($int != ""){
			$validate_int = true;
		}else{
			$validate_int = false;
			$error = "int";
		}

		if (!is_int($colonia) || !is_numeric($colonia) && !empty($colonia) && strlen($colonia) > 2 && strlen($colonia) < 100) {
			$validate_colonia = true;
		} else {
			$validate_colonia = false;
			$error = "colonia";
		}

		if (!is_int($municipio) || !is_numeric($municipio) && !empty($municipio) && strlen($municipio) > 2 && strlen($municipio) < 100) {
			$validate_municipio= true;
		} else {
			$validate_municipio = false;
			$error = "municipio";
		}

		if (strlen($mensaje) > 2 && strlen($mensaje) < 500 && !empty($mensaje)) {
			$validate_message = true;
		} else {
			$validate_message = false;
			$error = "mensaje";
		}
	}

	else {
		$error = "faltan_valores";
		header("Location:../index.php?error=$error");
	}

	if ($error != "ok") {
		header("Location:../index.php?error=" . $error);
	}elseif($error == "ok"){

		//asunto
		$asunto="10% Control de plaga Residencial";

		//destinatario
		$destino="juan_27angel@hotmail.com";

		//cabeceras para validar el formato HTML
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= "Content-type: text/html; charset=UTF-8\r\n";

		//contenido del mensaje
		$contenido='
		<html>
		<head></head>
		<body>
		<h3>'.$nombre.' ha solicitado el 20% en servicio de Residencial</h3>

		<hr style="border:2px solid #A6060E;"/>
		
		
		<p>'.$mensaje.' </p>
		
		<h3>Datos del cliente.</h3>
		<ul>
			<li><strong>Nombre: </strong> '.$nombre.'</li>
			<li><strong>Apellido: </strong> '.$apellido.'</li>
			<li><strong>E-mail: </strong> '.$email.'</li>
			<li><strong>Teléfono: </strong> '.$telefono.'</li>
			<li><strong>Empresa: </strong> '.$empresa.'</li>
			<li><strong>Giro empresarial: </strong> '.$giroEmpresarial.'</li>
			<li><strong>Calle: </strong> '.$calle.'</li>
			<li><strong>No Exterior: </strong> '.$ext.'</li>
			<li><strong>No Interior: </strong> '.$int.'</li>
			<li><strong>Colonia: </strong> '.$colonia.'</li>
			<li><strong>Municipio: </strong> '.$municipio.'</li>
			
		</ul>

		<br/>
		<br/>
		

		<hr style="border:2px solid #A6060E;"/>
		</body>
		</html>
		';

		//enviar correo
		$envio = mail($destino, $asunto, $contenido, $headers);

		if($envio){
			header("Location:gracias.html");
			//Enviando autorespuesta
			$pwf_header = "info@drenajesyfugas.com\n"
			."Reply-to: info@drenajesyfugas.com \n";
			$pwf_asunto = "Drefsa Confirmación";
			$pwf_dirigido_a = "$email";
			$pwf_mensaje = "$nombre Gracias por dejarnos su mensaje desde nuestro sitio web \n"
			."Su mensaje ha sido recibido satisfactoriamente \n"
			."Nos pondremos en contacto lo antes posible a su e-mail: $email o su telefono $telefono \n"
			."\n"
			."\n"
			."-----------------------------------------------------------------"
			."Favor de NO responder este e-mail ya que es generado Automaticamente.\n"
			."Atte: DREFSA Mtto. de Drenaje Industrial \n";
			@mail($pwf_dirigido_a, $pwf_asunto, $pwf_mensaje, $pwf_header);
		}else{
			header("Location:../index.php?error=Inténtelo de nuevo en unos momentos");
		}
	}
}

	error_reporting(0);
	$msjStatus = null;

	//valido si existe el botón ajax
	if(isset($_POST['ajax'])){

		//recojo los campos del formuario
		$name = htmlspecialchars($_POST['c_name']);
		$email = htmlspecialchars($_POST['c_email']);
		$phone = htmlspecialchars($_POST['c_phone']);
		$state = htmlspecialchars($_POST['c_state']);
		$city = htmlspecialchars($_POST['c_city']);
		$budget = htmlspecialchars($_POST['c_budget']);
		$radioValue = htmlspecialchars($_POST['radioValue']);
		$camp1 = htmlspecialchars($_POST['c_camp1']);
		$camp2 = htmlspecialchars($_POST['c_camp2']);
		$camp3 = htmlspecialchars($_POST['c_camp2']);
		$radioValue2 = htmlspecialchars($_POST['radioValue2']);
		$message = htmlspecialchars($_POST['c_message']);

		//Valido el campo nombre
		if($name == ""){
			$msjStatus = "<script>document.getElementById('nombre-status').innerHTML = 'el campo está vacío';</script>";
		}
		elseif(!preg_match('/^[a-záéóóúàèìòùäëïöüñ\s]+$/i', $name)){
			$msjStatus = "<script>document.getElementById('nombre-status').innerHTML = 'No se admiten n&uacute;meros en este campo';</script>";
		}
		elseif(strlen($name)<2){
			$msjStatus = "<script>document.getElementById('nombre-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}
		elseif(strlen($name)>100){
			$msjStatus = "<script>document.getElementById('nombre-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//validar campo email
		elseif($email == ""){
			$msjStatus = "<script>document.getElementById('email-status').innerHTML = 'El campo est&aacute; vac&iacute;o';</script>";
		}

		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$msjStatus = "<script>document.getElementById('email-status').innerHTML = 'Introduce un email v&aacute;lido';</script>";
		}

		elseif(strlen($email)<2){
			$msjStatus = "<script>document.getElementById('email-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}

		elseif(strlen($email)>100){
			$msjStatus = "<script>document.getElementById('email-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//Validar campo teléfono
		elseif($phone == ""){
			$msjStatus = "<script>document.getElementById('telefono-status').innerHTML = 'El campo est&aacute vac&iacute;o';</script>";
		}

		elseif(strlen($phone)<2){
			$msjStatus = "<script>document.getElementById('telefono-status').innerHTML = 'M&iacute;nimo 2 d&iacute;gitos';</script>";
		}

		elseif(strlen($phone)>15){
			$msjStatus = "<script>document.getElementById('telefono-status').innerHTML = 'M&aacute;ximo 15 d&iacute;gitos';</script>";
		}

		elseif(!preg_match("/^[0-9]+$/", $phone)){
			$msjStatus = "<script>document.getElementById('telefono-status').innerHTML = 'No se admiten letras en este campo';</script>";
		}

		//validar campo estado
		elseif($state == ""){
			$msjStatus = "<script>document.getElementById('estado-status').innerHTML = 'El campo est&aacute; vac&iacute;o';</script>";
		}

		elseif(strlen($state)<2){
			$msjStatus = "<script>document.getElementById('estado-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}

		elseif(strlen($state)>100){
			$msjStatus = "<script>document.getElementById('estado-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//validar campo ciudad
		elseif($city == ""){
			$msjStatus = "<script>document.getElementById('ciudad-status').innerHTML = 'El campo est&aacute; vac&iacute;o';</script>";
		}

		elseif(strlen($city)<2){
			$msjStatus = "<script>document.getElementById('ciudad-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}

		elseif(strlen($city)>100){
			$msjStatus = "<script>document.getElementById('ciudad-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//validar campo presupuesto
		elseif($budget == ""){
			$msjStatus = "<script>document.getElementById('presupuesto-status').innerHTML = 'El campo est&aacute; vac&iacute;o';</script>";
		}

		elseif(strlen($budget)<2){
			$msjStatus = "<script>document.getElementById('presupuesto-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}

		elseif(strlen($budget)>100){
			$msjStatus = "<script>document.getElementById('presupuesto-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//validar campo terreno
		elseif($radioValue == ""){
			$msjStatus = "<script>document.getElementById('terreno-status').innerHTML = 'Debes seleccionar una opción';</script>";
		}

		//validar campo camp1
		elseif($camp1 == ""){
			$msjStatus = "<script>document.getElementById('camp1-status').innerHTML = 'El campo est&aacute; vac&iacute;o';</script>";
		}

		elseif(strlen($camp1)<2){
			$msjStatus = "<script>document.getElementById('camp1-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}

		elseif(strlen($camp1)>100){
			$msjStatus = "<script>document.getElementById('camp1-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//validar campo camp2
		elseif($camp2 == ""){
			$msjStatus = "<script>document.getElementById('camp2-status').innerHTML = 'El campo est&aacute; vac&iacute;o';</script>";
		}

		elseif(strlen($camp2)<2){
			$msjStatus = "<script>document.getElementById('camp2-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}

		elseif(strlen($camp2)>100){
			$msjStatus = "<script>document.getElementById('camp2-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//validar campo camp3
		elseif($camp3 == ""){
			$msjStatus = "<script>document.getElementById('camp3-status').innerHTML = 'El campo est&aacute; vac&iacute;o';</script>";
		}

		elseif(strlen($camp3)<2){
			$msjStatus = "<script>document.getElementById('camp3-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}

		elseif(strlen($camp3)>100){
			$msjStatus = "<script>document.getElementById('camp3-status').innerHTML = 'M&aacute;ximo 100 caracteres';</script>";
		}

		//validar campo radio 2
		elseif($radioValue2 == ""){
			$msjStatus = "<script>document.getElementById('interest-status').innerHTML = 'Debes seleccionar una opción';</script>";
		}
	
		//Valido el campo mensaje
		elseif($message == ""){
			$msjStatus = "<script>document.getElementById('mensaje-status').innerHTML = 'el campo está vacío';</script>";
		}
		elseif(strlen($message)<2){
			$msjStatus = "<script>document.getElementById('mensaje-status').innerHTML = 'mínimo 2 caracteres';</script>";
		}
		elseif(strlen($message)>500){
			$msjStatus = "<script>document.getElementById('mensaje-status').innerHTML = 'M&aacute;ximo 500 caracteres';</script>";
		}

		//validar los términos y condiciones
		elseif(!isset($_POST['c_terms']) && $_POST['c_terms'] != "on"){
			$msjStatus = "<script>document.getElementById('terms-status').innerHTML = 'Debes aceptar los términos y condiciones';</script>";
		}

		else{
			//a quién será enviado
			$destino = "juan_27angel@hotmail.com";

			//asunto
			$asunto = "Mensaje enviado desde la página web";

			//cabeceras para el envío del mail en formato html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8\r\n";

			//contenido del mensaje
			$contenido = '
				<!DOCTYPE html>
				<html lang="es">
				<head></head>
				<body>
					<h2>' . $name . ' ha enviado el siguiente mensaje a través de tu sitio web:</h2>
					<hr>
				
					<p>' . $message . '</p>

					<hr>

					<h5>Información del formulario</h5>

					<ul>
						<li>Estado: '.$state.'</li>
						<li>Ciudad: '.$city.'</li>
						<li>Presupuesto aproximado: '.$budget.'</li>
						<li>¿Cuentas con terreno?: '.$radioValue.'</li>
						<li>m2: '.$camp1.'</li>
						<li>Ancho: '.$camp2.'</li>
						<li>Largo: '.$camp3.'</li>
						<li>¿Estas interesado en un proyecto Llave en mano?: '.$radioValue2.'</li>
					</ul>

					<p>Contacta a  <strong>' . $name . '</strong> al correo:  <span style="color:blue;"> ' . $email . '</span> o al teléfono '. $phone .' </p>
					
					<p>Ir a mi sitio web <span style="color:blue">http://www.</span></p>
				</body>
				</html>
			';

			//envío de mail
			$envio = mail($destino, $asunto, $contenido, $headers);

			if ($envio) {
				echo "Enviado correctamente";

				//enviando autorespuesta
				$pfw_header = "From: ventas@enlacesprobus.com.mx"
					. "Reply-To: ventas@enlacesprobus.com.mx";
				$pfw_subject = "Mensaje recibido";
				$pfw_email_to = "$email";
				$pfw_message = "Muchas Gracias $name, por su mensaje: $message "
					. "Su mensaje ha sido recibido satisfactoriamente - "
					. "Nos pondremos en contacto contigo lo antes posible en su e-mail: $email "
					. " n"
					. " n"
					. "--------------------------------------------------------------------------n"
					. "Favor de NO responder este E-mail ya que es generado Automáticamente.n";
				@mail($pfw_email_to, $pfw_subject, $pfw_message, $pfw_header);
			} else {
				echo "Falló el envío";			
			}
		}
	}

	echo $msjStatus;

<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section class="bg-gray padding-top-bottom-50">
			<div class="container">
				<h2 class="title-page"><?php the_title(); ?></h2>
				<div class="row text-center">
					<div class="icons-redes color-primary-link">
						<a href=""><em class="icon-instagram-filled margin-left-10"></em></a>
						<a href=""><em class="icon-facebook-rect"></em></a>
						<a href=""><em class="icon-youtube"></em></a>
						<a href=""><em class="icon-whatsapp"></em></a>
					</div><br>
					<p class="color-primary-link"><a href="tel:+5518339080"><em class="icon-phone-circled"></em>044 55 18339080</a></p>
					<p class="color-primary-link"><a href="" class="contact-email"><em class="icon-mail-alt"></em>contacto<span>@</span>vyartesublimacion.com</a></p><br>
					<p>¿Ninguno de nuestros servicios se adapta a lo que quieres?<br>Te cotizamos un servicio personalizado<br>¡Contáctanos!</p><br>
					<form id="contact-form" name="contact-form" action=""  method="post" class="validation" data-parsley-contacto>
						<input type="text" id="contactoNombre" name="contactoNombre" placeholder="Nombre" required data-parsley-length="[7, 40]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 7 a 40 caracteres.">
						<input type="email" id="contactoEmail" name="contactoEmail" placeholder="Email" required data-parsley-type="email" data-parsley-type-message="La dirección de correo es inválida" data-parsley-required-message="El campo es obligatorio.">
						<select name="contactoServicio" id="contactoServicio" required data-parsley-required-message="El campo es obligatorio.">
							<option value="Diseño de logotipo">Diseño de logotipo</option>
							<option value="Redes sociales">Redes sociales</option>
							<option value="Artes para instagram o facebook">Artes para instagram o facebook</option>
							<option value="Tarjetas de presentación">Tarjetas de presentación</option>
							<option value="Volantes">Volantes</option>
							<option value="Firma electrónica">Firma electrónica</option>
						</select>
						<textarea id="contactoMensaje" name="contactoMensaje" placeholder="Danos detalles de lo que estás buscando" required data-parsley-length="[20, 600]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 20 a 600 caracteres."></textarea>
						<input type="submit" name="submitContact" class="btn inline-block" value="Enviar" />
						<input type="hidden" name="btnSubmitContact" value="post" />
						<?php wp_nonce_field( 'contact-form' ); ?>
					</form>
				</div>				
			</div>
		</section>

		<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitContact'] )){

		    $to 				= "contacto@vyartesublimacion.com";
		    
		    $subject 			= "Servicios de diseño personalizado";

		    $contactoNombre 	= $_POST['contactoNombre'];
		    $contactoEmail 		= $_POST['contactoEmail'];
		    $contactoServicio 	= $_POST['contactoServicio'];
		    $contactoMensaje 	= $_POST['contactoMensaje'];		

			$message 			= '<html style="font-family: Arial, sans-serif; font-size: 14px;"><body>';
			$message 		   .= '<div style="text-align: center; background-color: #00B4EF; margin-bottom: 20px;"><img style="display: inline-block; margin: auto;" src="http://vyarte.com/wp-content/themes/vyarte/images/email/logo.png" alt="Logo Vyarte"></div>';
			$message 		   .= '<h1 style="display: block; margin-bottom: 20px; text-align: center;  font-size: 20px; font-weight: 700; color: #00B4EF; text-transform: uppercase;">Contacto Vyarte</h1>';
			$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">De: </span>' . $contactoNombre . '</p>';
			$message 			.= '<p style="color: #000;"><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Correo: </span>' . $contactoEmail . '</p></br>';
			$message 			.= '<p style="color: #000;"><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Servicio: </span>' . $contactoServicio . '</p></br>';
			$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Comentario: </span>' . $contactoMensaje . '</p>';
			$message 			.= '<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;"><p><small>Este email fue enviado desde el formulario de contacto de Vyarte.</small></p></div>';
			$message 	        .= '</body></html>';

			//if ( $contactoNombre != '' && $contactoAsunto != '' &&  $contactoEmail != '' &&  $contactoMensaje != '' ) {
				wp_mail($to, $subject, $message);
			//}

		    /* Contacto como post */
			$title 		= 'Diseño gráfico personalizado de ' . $contactoNombre;
			$content 	= 'De: ' . $contactoNombre . '<br>Correo: ' . $contactoEmail . '<br>Servicio: ' . $contactoServicio . '<br>Comentario: ' . $contactoMensaje;

			$post = array(
				'post_title'	=> wp_strip_all_tags($title),
				'post_content'	=> $content,
				'post_status'	=> 'publish',
				'post_type' 	=> 'vy_contacto'
			);

			$my_post_id = wp_insert_post($post); //send our post, save the resulting ID

		}
		?>

	<?php endwhile; endif; 
get_footer(); ?>
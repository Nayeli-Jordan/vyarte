<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section class="bg-gray padding-top-bottom-50">
			<div class="container">
				<h2 class="title-page"><?php the_title(); ?></h2>
				<div class="row text-center">
					<?php include (TEMPLATEPATH . '/template/redes-contacto.php'); ?>
					<p class="color-primary-link"><a href="tel:+5518339080"><em class="icon-phone-circled"></em>044 55 18339080</a></p>
					<p class="color-primary-link"><a href="" class="contact-email"><em class="icon-mail-alt"></em>contacto<span>@</span>vyartesublimacion.com</a></p><br>
					<p>¿Deseas conocer más detalles sobre nuestros productos?<br>¿Buscas algo en particular?<br>¡Contáctanos!</p><br>
					<form id="contact-form" name="contact-form" action=""  method="post" class="validation" data-parsley-contacto>
						<input type="text" id="contactoNombre" name="contactoNombre" placeholder="Nombre" required data-parsley-length="[7, 40]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 7 a 40 caracteres.">
						<input type="email" id="contactoEmail" name="contactoEmail" placeholder="Email" required data-parsley-type="email" data-parsley-type-message="La dirección de correo es inválida" data-parsley-required-message="El campo es obligatorio.">
						<input type="text" id="contactoAsunto" name="contactoAsunto" placeholder="Asunto" required data-parsley-length="[7, 40]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 7 a 40 caracteres.">
						<textarea id="contactoMensaje" name="contactoMensaje" placeholder="Mensaje" required data-parsley-length="[20, 200]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 20 a 200 caracteres."></textarea>
						<input type="submit" name="submitContact" class="btn inline-block" value="Enviar" />
						<input type="hidden" name="btnSubmitContact" value="post" />
						<?php wp_nonce_field( 'contact-form' ); ?>
					</form>
				</div>				
			</div>
		</section>

		<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitContact'] )){

		    $to 				= "contacto@vyartesublimacion.com";		    

		    $contactoNombre 	= $_POST['contactoNombre'];
		    $contactoEmail 		= $_POST['contactoEmail'];
		    $contactoAsunto 	= $_POST['contactoAsunto'];
		    $contactoMensaje 	= $_POST['contactoMensaje'];

		    $subject 			= "Contacto Vyarte - " . $contactoAsunto;	

			$message 			= '<html style="font-family: Arial, sans-serif; font-size: 14px;"><body>';
			$message 		   .= '<h1 style="display: block; margin-bottom: 20px; text-align: center;  font-size: 20px; font-weight: 700; color: #00B4EF; text-transform: uppercase;">Contacto Vyarte</h1>';
			$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">De: </span>' . $contactoNombre . '</p>';
			$message 			.= '<p style="color: #000;"><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Correo: </span>' . $contactoEmail . '</p></br>';
			$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Asunto: </span>' . $contactoAsunto . '</p>';
			$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Comentario: </span>' . $contactoMensaje . '</p>';
			$message 			.= '<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;"><p><small>Este email fue enviado desde el formulario de contacto de Vyarte.</small></p></div>';
			$message 	        .= '</body></html>';

			//if ( $contactoNombre != '' && $contactoAsunto != '' &&  $contactoEmail != '' &&  $contactoMensaje != '' ) {
				wp_mail($to, $subject, $message);
			//}

		    /* Contacto como post */
			$title 		= 'Contacto de ' . $contactoNombre;
			$content 	= 'De: ' . $contactoNombre . '<br>Correo: ' . $contactoEmail . '<br>Asunto: ' . $contactoAsunto . '<br>Comentario: ' . $contactoMensaje;

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
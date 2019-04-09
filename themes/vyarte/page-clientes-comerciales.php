<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section>
			<div class="bg-category bg-image margin-bottom-30" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)">
				<div class="bg-opacity-dark bg-absolute"></div>
				<div class="content-center text-center padding-left-right-20 color-light">
					<h2 class="margin-bottom-10"><?php the_title(); ?></h2>
					<?php the_content(); ?>					
				</div>
			</div>
			<div class="container">
				<h3 class="margin-bottom-30">Aquí algunos de nuestros clientes:</h3>
				<article id="sliderDg" class="text-center">
					<div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-timeout="3500" data-cycle-slides="> div" data-cycle-prev="#prevSlider" data-cycle-next="#nextSlider"><!--   -->
						<!-- to do - http://jquery.malsup.com/cycle2/demo/carousel.php -->
						<?php
						$dgServ_args = array(
						'post_type' 		=> 'cliente',
						'posts_per_page' 	=> 12,
						);
						$dgServ_query = new WP_Query( $dgServ_args );
						if ( $dgServ_query->have_posts() ) : $i = 1;
							while ( $dgServ_query->have_posts() ) : $dgServ_query->the_post(); ?>
								<?php if ($i === 1 || $i === 5 || $i === 9): ?>
									<div>
								<?php endif ?>
									<div class="content-logo bg-image bg-contain"  style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)">
										<!-- <img src="<?php the_post_thumbnail_url('large'); ?>"> -->
									</div>
								<?php if ($i === 4 || $i === 8 || $i === 12): ?>
									</div>
								<?php endif ?>
							<?php $i ++; endwhile; wp_reset_postdata();
							/* Si no cerro */
							if ($i != 4 || $i != 8 || $i != 12): echo "</div>"; endif;
						endif; ?>
					</div> <!-- end cycle-slideshow -->
				</article>
			</div>
		</section>
		<section class="bg-gray padding-top-bottom-50 margin-top-50">
			<div class="container">
				<div class="row text-center">
					<div class="col s12 m10 offset-m1 l8 offset-l2">
						<h3 class="margin-bottom-30">¿Deseas nuestros servicios?</h3>
						<p class="margin-bottom-30">¡En VyArte Publicidad todo es posible! Contamos con grandes colaboraciones en el ámbito profesional, ¡hemos colaborado con grandes marcas ayudándoles a potencializar su mercado en el mundo digital por medio del diseño! ¿Qué esperas? ¡Conoce nuestro trabajo y agenda una cita con nosotros!</p>
					</div>
					<div class="clearfix"></div>
					<?php include (TEMPLATEPATH . '/template/redes-contacto.php'); ?>
					<p class="color-primary-link"><a href="tel:+5518339080"><em class="icon-phone-circled"></em>044 55 18339080</a></p>
					<p class="color-primary-link"><a href="" class="contact-email"><em class="icon-mail-alt"></em>contacto<span>@</span>vyartesublimacion.com</a></p><br>
					<p>¿Quieres cotizar un servicio para tu negocio?<br>¡Contáctanos!</p><br>
					<form id="contact-form" name="contact-form" action=""  method="post" class="validation" data-parsley-contacto>
						<input type="text" id="contactoNombre" name="contactoNombre" placeholder="Nombre" required data-parsley-length="[7, 40]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 7 a 40 caracteres.">
						<input type="email" id="contactoEmail" name="contactoEmail" placeholder="Email" required data-parsley-type="email" data-parsley-type-message="La dirección de correo es inválida" data-parsley-required-message="El campo es obligatorio.">
						<input type="tel" id="contactoTel" name="contactoTel" placeholder="Teléfono" required data-parsley-type="tel" data-parsley-type-message="El teléfono es inválido" data-parsley-required-message="El campo es obligatorio.">
						<textarea id="contactoMensaje" name="contactoMensaje" placeholder="Cuentanos lo que estás buscando" required data-parsley-length="[20, 600]" data-parsley-required-message="El campo es obligatorio." data-parsley-length-message="Se requieren de 20 a 600 caracteres."></textarea>
						<input type="submit" name="submitContact" class="btn inline-block" value="Enviar" />
						<input type="hidden" name="btnSubmitContact" value="post" />
						<?php wp_nonce_field( 'contact-form' ); ?>
					</form>
				</div>				
			</div>
		</section>

		<?php if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitContact'] )){

		    $to 				= "contacto@vyartesublimacion.com";
		    
		    $subject 			= "Cliente comercial";

		    $contactoNombre 	= $_POST['contactoNombre'];
		    $contactoEmail 		= $_POST['contactoEmail'];
		    $contactoTel 		= $_POST['contactoTel'];
		    $contactoMensaje 	= $_POST['contactoMensaje'];		

			$message 			= '<html style="font-family: Arial, sans-serif; font-size: 14px;"><body>';
			$message 		   .= '<h1 style="display: block; margin-bottom: 20px; text-align: center;  font-size: 20px; font-weight: 700; color: #00B4EF; text-transform: uppercase;">Contacto Cliente Comercial</h1>';
			$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">De: </span>' . $contactoNombre . '</p>';
			$message 			.= '<p style="color: #000;"><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Correo: </span>' . $contactoEmail . '</p></br>';
			$message 			.= '<p style="color: #000;"><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Teléfono: </span>' . $contactoTel . '</p></br>';
			$message 			.= '<p><span style="text-transform: uppercase; font-weight: 600; color: #00B4EF;">Comentario: </span>' . $contactoMensaje . '</p>';
			$message 			.= '<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;"><p><small>Este email fue enviado desde el formulario de contacto de Vyarte.</small></p></div>';
			$message 	        .= '</body></html>';

			//if ( $contactoNombre != '' && $contactoAsunto != '' &&  $contactoEmail != '' &&  $contactoMensaje != '' ) {
				wp_mail($to, $subject, $message);
			//}

		    /* Contacto como post */
			$title 		= 'Cliente comercial de ' . $contactoNombre;
			$content 	= 'De: ' . $contactoNombre . '<br>Correo: ' . $contactoEmail . '<br>Teléfono: ' . $contactoTel . '<br>Comentario: ' . $contactoMensaje;

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
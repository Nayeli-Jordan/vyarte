			<footer>
				<div class="container">
	 				<div class="row">
	 					<div class="col s12 sm6 m4">
	 						<p class="title-nav-footer">Menú</p>
	 						<ul>
		 					<?php
								$menu_name = 'footer_menu';

								if (( $locations = get_nav_menu_locations()) && isset( $locations[ $menu_name ])) {
									$menu = wp_get_nav_menu_object( $locations[ $menu_name ]);
									$menu_items = wp_get_nav_menu_items( $menu->term_id );
									$menu_list = '';
									foreach ( (array) $menu_items as $key => $menu_item) {

										$url 				= $menu_item->url;
										$title 				= $menu_item->title;
										$class 				= esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );
										$description		= $menu_item->description;

										$currentPage 		= '';
										if ($description != '') {
											if ($description === 'inicio' && is_front_page()) {
												$currentPage	='active';
											}
											if (is_page($description)) {
												$currentPage	='active';
											}
											if ($description === 'tienda' && is_shop()) {
												$currentPage	='active';
											}								
										}

										/*Eliminar link servicios*/
										if ($title === 'Servicios') { 
											if (is_front_page()) :
												$menu_list .='<li itemprop="actionOption" class="' . $class . '"><p class="customLink ' . $currentPage . '">' . $title . '</p></li>';
											else:
												$menu_list .='<li itemprop="actionOption" class="' . $class . '"><a href="' . $url . '" class="' . $currentPage . '">' . $title . '</a></li>';	
											endif;										
										} else {
											$menu_list .='<li itemprop="actionOption" class="' . $class . '"><a href="' . $url . '" class="' . $currentPage . '">' . $title . '</a></li>';	
										}
									}
								}
								echo $menu_list;
							?>	 							
	 						</ul>

	 					</div>
	 					<div class="col s12 sm6 m4">
	 						<p class="title-nav-footer">Sobre Vyarte</p>
	 						<ul>
		 					<?php
								$menu_name = 'vyarte_menu';

								if (( $locations = get_nav_menu_locations()) && isset( $locations[ $menu_name ])) {
									$menu = wp_get_nav_menu_object( $locations[ $menu_name ]);
									$menu_items = wp_get_nav_menu_items( $menu->term_id );
									$menu_list = '';
									foreach ( (array) $menu_items as $key => $menu_item) {

										$url 				= $menu_item->url;
										$title 				= $menu_item->title;
										$class 				= esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );
										$description		= $menu_item->description;

										$currentPage 		= '';
										if ($description != '') {
											if (is_page($description)) {
												$currentPage	='active';
											}							
										}

										$menu_list .='<li itemprop="actionOption" class="' . $class .'"><a href="' . $url . '" class="' . $currentPage . '">' . $title . '</a></li>';
									}
								}
								echo $menu_list;
							?>	 							
	 						</ul>
	 					</div>
	 					<div class="col s12 sm12 m4">
	 						<p class="title-nav-footer">Contacto</p>
	 						<div class="icons-redes">
								<a href=""><em class="icon-instagram-filled margin-left-10"></em></a>			
								<a href=""><em class="icon-facebook-rect"></em></a>
								<a href=""><em class="icon-twitter-squared"></em></a>
							</div>
							<p>Contáctanos</p>
							<p><a href="tel:+5518339080"><em class="icon-phone-circled"></em>044 55 18339080</a></p>
							<p><a href="" id="contact-email"><em class="icon-mail-alt"></em>contacto<span>@</span>vyarte.com</a></p>
	 					</div>
	 				</div>
	 				<div class="text-center">
		 				<p class="margin-bottom-10">© 2019 VyArte | Desarrollado por LJDevelopment</p>
		 				<div class="icons-pago">
		 					<em class="icon-cc-visa"></em>
		 					<em class="icon-cc-mastercard"></em>
		 					<em class="icon-cc-paypal"></em>
		 				</div> 					
	 				</div>					
				</div>

			</footer>
		</div> <!-- end main-body -->
		<?php wp_footer(); ?>
	</body>
</html>
var $=jQuery.noConflict();
 
(function($){
	"use strict";
	$(function(){
 
		/*------------------------------------*\
			#GLOBAL
		\*------------------------------------*/

		$(document).ready(function() {
			footerBottom();
			
			// Validation form
			$('form.validation').parsley();

			/* Si se ha contactado */
			if(window.location.href.indexOf("#contacto-enviado") > -1) {
				console.log('Contacto enviado');
				$('#modal-contacto_enviado').show();
			}
			/* Si se ha enviado una personalizacion */
			if(window.location.href.indexOf("#personalizacion-enviada") > -1) {
				console.log('Personalización enviada');
				$('#modal-personalizacion-enviada').show();
			}
			/* Si se ha enviado una NO personalizacion */
			if(window.location.href.indexOf("#personalizacion-cancelada") > -1) {
				console.log('Personalización cancelada');
				$('#modal-personalizacion-cancelada').show();
			}
		});
 
		$(window).on('resize', function(){
			footerBottom();
		});
 
		$(document).scroll(function() {

		});
 
		// if( parseInt( isHome ) ){

		// } 

		// if( parseInt( isSingular ) ){

		// } 

		// Nav Mobile
		$("#btn-open-nav").click(function() {
			$('.js-header nav > ul').addClass('open');
			$('body').addClass('overflow-hide');
		});
		$("#btn-close-nav").click(function() {
			$('.js-header nav > ul').removeClass('open');
			$('body').removeClass('overflow-hide');
		});

		/*Buscador*/
		$("#linkSearchProduct").click(function() {
			if($(this).hasClass('active')){
				$('#linkSearchProduct, .searchProduct').removeClass('active');
			} else {
				$('#linkSearchProduct, .searchProduct').addClass('active');			
			}
		});

		//Single Product
		//Review 
		$(".comment_container .description p").click(function() {
			var idComment = $(this).parent().parent().parent().attr('id');
			console.log(idComment);
			$('#' + idComment + ' .description p').addClass('active');
		});
		$(".comment_container .description p.active").click(function() {
			$('#' + idComment + ' .description p.active').removeClass('active');
		});
		//Gallery
		if ($('.galleryImage').length) {
			$('#prevGallery, #nextGallery').removeClass('hide');
		}

		/*Faq´s*/
		$(".content-faq:not(.active)").click(function() {
			var idFaq = $(this).attr('id');
			console.log(idFaq);
			if($('#' + idFaq).hasClass('active')){
				$(this).removeClass('active');
			} else {
				$('.content-faq').removeClass('active');
				$('#' + idFaq).addClass('active');				
			}
		});

		/*Email*/
		$(".contact-email").click(function() {
			$(this).attr('href', 'mailto:contacto@vyartesublimacion.com');
		});

		//Scroll menú
		$(".scrollContacto").click(function() {
			$('html, body').animate({		
				scrollTop: $('Footer').offset().top - 30
			}, 1000);
		});
		$(".scrollservHome").click(function() {
			$('html, body').animate({		
				scrollTop: $('#servHome').offset().top - 30
			}, 1000);
		});

		// Modal
		$(".open-modal").click(function() {
			var idModal = $(this).attr('id');
			$('#modal-' + idModal).show();
			$('body').addClass('overflow-hide');
		});
		$(".close-modal, .exit-modal").click(function() {
			$('.modal').hide();
			$('body').removeClass('overflow-hide');
		});
	});
})(jQuery);
 
/**
 * Fija el footer abajo
 */

function footerBottom(){
	var alturaFooter = getFooterHeight();
	$('.main-body').css('padding-bottom', alturaFooter );
}
function getHeaderHeight(){
	return $('.js-header').outerHeight();
}// getHeaderHeight
function getFooterHeight(){
	return $('footer').outerHeight();
}// getFooterHeight


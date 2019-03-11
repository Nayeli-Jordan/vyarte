var $=jQuery.noConflict();
 
(function($){
	"use strict";
	$(function(){
 
		/*------------------------------------*\
			#GLOBAL
		\*------------------------------------*/

		$(document).ready(function() {
			footerBottom();
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

		// Modal
		/*$(".open-modal").click(function() {
			var idModal = $(this).attr('id');
			$('#modal-' + idModal).show();
			$('body').addClass('overflow-hide');
		});
		$(".close-modal, .exit-modal").click(function() {
			$('.modal').hide();
			$('body').removeClass('overflow-hide');
		});*/

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
		$("#contact-email").click(function() {
			$(this).attr('href', 'mailto:contacto@vyarte.com');
		});

		//Scroll menú
		$(".scrollContacto").click(function() {
			$('html, body').animate({		
				scrollTop: $('Footer').offset().top // - 50
			}, 1000);
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


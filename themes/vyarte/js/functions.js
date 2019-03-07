var $=jQuery.noConflict();
 
(function($){
	"use strict";
	$(function(){
 
		/*------------------------------------*\
			#GLOBAL
		\*------------------------------------*/

		$(document).ready(function() {
			//footerBottom();
		});
 
		$(window).on('resize', function(){
			//footerBottom();
		});
 
		$(document).scroll(function() {

		});
 
		// if( parseInt( isHome ) ){

		// } 

		// if( parseInt( isSingular ) ){

		// } 

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

		//Single Product - Review 
		$(".comment_container .description p").click(function() {
			var idComment = $(this).parent().parent().parent().attr('id');
			console.log(idComment);
			$('#' + idComment + ' .description p').addClass('active');
		});

		$(".comment_container .description p.active").click(function() {
			$('#' + idComment + ' .description p.active').removeClass('active');
		});
	});
})(jQuery);
 
/**
 * Fija el footer abajo
 */
/*
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
*/

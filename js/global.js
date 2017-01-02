;
(function ($) {


	// Sticky Footer
	var bumpIt = function() {
			$('body').css('padding-bottom', $('.footer').outerHeight(true));
			$('.footer').addClass('sticky-footer');
		},
		didResize = false;

	$(window).resize(function() {
		didResize = true;
	});
	setInterval(function() {
		if(didResize) {
			didResize = false;
			bumpIt();
		}
	}, 250);

	// Scripts which runs after DOM load

	$(document).ready(function () {

		//Remove placeholder on click
		$("input,textarea").each(function () {
			$(this).data('holder', $(this).attr('placeholder'));

			$(this).focusin(function () {
				$(this).attr('placeholder', '');
			});

			$(this).focusout(function () {
				$(this).attr('placeholder', $(this).data('holder'));
			});
		});

		//Make elements equal height
		$('.matchHeight').matchHeight();


		// Add fancybox to images
		$('.gallery-item a').attr('rel', 'gallery');
		$('a[rel*="album"], .gallery-item a, .fancybox, a[href$="jpg"], a[href$="png"], a[href$="gif"]').fancybox({
			minHeight: 0,
			helpers: {
				overlay: {
					locked: false
				}
			}
		});

		// Sticky footer
		bumpIt();


	});


	// Scripts which runs after all elements load

	$(window).load(function () {

		//jQuery code goes here


	});

	// Scripts which runs at window resize

	$(window).resize(function () {

		//jQuery code goes here


	});

}(jQuery));

(function($){
	
	// Add "loaded" class when a section has been loaded
	$(window).scroll(function() { 
		var scrollTop = $(window).scrollTop();
		$(".section").each(function() {
			var elementTop = $(this).offset().top - $('#header').outerHeight();
			if(scrollTop >= elementTop) {
				$(this).addClass('loaded');
			}
		});
	});

	// One Page Navigation Setup
	$('#navigation').singlePageNav({
		offset: $('#navbar').outerHeight(),
		filter: ':not(.external)',
		speed: 750,
		currentClass: 'active',
		
		beforeStart: function() {
		},
		onComplete: function() {
		}
	});

	// Sticky Navbar Affix
	$('#navbar').affix({
		offset: {
		top: $('#topbar').outerHeight(),
		}
	});

	// Smooth Hash Link Scroll
	$('.smooth-scroll').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});

	$('.nav a').on('click', function(){
		if($('.navbar-toggle').css('display') !='none'){
			$(".navbar-toggle").click();
		}
	});

	var $container = $('.portfolio-isotope');
		$container.imagesLoaded(function(){
			$container.isotope({
			itemSelector : '.portfolio-item',
			resizable: true,
			resizesContainer: true
		});
	});

// filter items when filter link is clicked
	$('#filters a').click(function(){
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });
		return false;
	});
	
	/*$(".btn-continue").on("click", function(e){
		e.preventDefault();
		sessionStorage.setItem("user", "exist");
		window.location = "http://synergistics.ae/goldtracker";
	}); */
	
	setTimeout(function showIphonePopup(){
		if(navigator.userAgent.match(/iPhone/i)) {
			if (document.cookie.indexOf("iphone_redirect=false") == -1) {
				$(".iphone-popup .device-name").text("iPhone")
				$(".iphone-popup").show();
			}
		}
		if(navigator.userAgent.match(/iPad/i)){
			$(".iphone-popup .device-name").text("iPad");
			$(".iphone-popup").show();
		}
	}, 5000)
	
})(jQuery);
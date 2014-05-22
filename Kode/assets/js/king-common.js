$(document).ready(function(){

	/************************
	/*	top bar
	/************************/

	if( $('.top-general-alert').length > 0 ) {
		$('.top-general-alert').delay(800).slideDown('medium');

		$('.top-general-alert .close').click( function() {
			$(this).parent().slideUp('fast');
		});
	}

	/************************
	/*	main navigation
	/************************/

	$('.main-menu .js-sub-menu-toggle').click( function(e){

		e.preventDefault();

		$li = $(this).parents('li');
		if( !$li.hasClass('active')){
			$li.find('.toggle-icon').removeClass('fa-angle-left').addClass('fa-angle-down');
			$li.addClass('active');
		} 					
		else {
			$li.find('.toggle-icon').removeClass('fa-angle-down').addClass('fa-angle-left');
			$li.removeClass('active');
		} 
	
		$li.find('.sub-menu').slideToggle(300);
	});

	$('.js-toggle-minified').toggle(
		function() {
			$('.left-sidebar').addClass('minified');
			$('.content-wrapper').addClass('expanded');

			$('.left-sidebar .sub-menu')
			.css('display', 'none')
			.css('overflow', 'hidden'); 
			
			$('.sidebar-minified').find('i.fa-angle-left').toggleClass('fa-angle-right');
		},
		function() {
			$('.left-sidebar').removeClass('minified');
			$('.content-wrapper').removeClass('expanded');
			$('.sidebar-minified').find('i.fa-angle-left').toggleClass('fa-angle-right');
		}
	);

	// main responsive nav toggle
	$('.main-nav-toggle').toggle(
		function() {
			$('.left-sidebar').slideDown(300)
		},
		function() {
			$('.left-sidebar').slideUp(300);
		}
	);

	//*******************************************
	/*	LIVE SEARCH
	/********************************************/
	$mainContentCopy = $('.main-content').clone();
	$('.searchbox input[type="search"]').keydown( function(e) {
		var $this = $(this);
		
		setTimeout(function() {
			var query = $this.val();
			
			if( query.length > 2 ) {
				var regex = new RegExp(query, "i");
				var filteredWidget = [];

				$('.widget-header h3').each( function(index, el){
					var matches = $(this).text().match(regex);

					if( matches != "" && matches != null ) {						
						filteredWidget.push( $(this).parents('.widget') );
					}
				});
				
				if( filteredWidget.length > 0 ) {
					$('.main-content .widget').hide();
					$.each( filteredWidget, function(key, widget) {
						widget.show();
					});
				}else{
					console.log('widget not found');					
				}
			}else {
				$('.main-content .widget').show();		
			}				
		}, 0);
	});

	/************************
	/*	WIDGET
	/************************/

	$('.widget').hover( 
		function(){
			$(this).find('.widget-header-toolbar.btn-init-hide').show();
		},
		function(){
			$(this).find('.widget-header-toolbar.btn-init-hide').hide();
		}
	);

	// widget remove
	$('.widget .btn-remove').click(function(e){

		e.preventDefault();
		$(this).parents('.widget').fadeOut(300, function(){
			$(this).remove();
		});
	});

	// widget toggle expand
	$('.widget .btn-toggle-expand').toggle(
		function(e) {
			e.preventDefault();
			$(this).parents('.widget').find('.widget-content').slideUp(300);
			$(this).find('i.fa-chevron-up').toggleClass('fa-chevron-down');		
		},
		function(e) {
			e.preventDefault();
			$(this).parents('.widget').find('.widget-content').slideDown(300);
			$(this).find('i.fa-chevron-up').toggleClass('fa-chevron-down');
		}
	);

	// widget focus
	$('.widget .btn-focus').toggle(
		function(e) {
			e.preventDefault();
			$(this).find('i.fa-eye').toggleClass('fa-eye-slash');
			$(this).parents('.widget').find('.btn-remove').addClass('link-disabled');
			$(this).parents('.widget').addClass('widget-focus-enabled'); 			
			$('<div id="focus-overlay"></div>').hide().appendTo('body').fadeIn(300); 			

		},
		function(e) {
			e.preventDefault();
			$theWidget = $(this).parents('.widget');
			
			$(this).find('i.fa-eye').toggleClass('fa-eye-slash');
			$theWidget.find('.btn-remove').removeClass('link-disabled');
			$('body').find('#focus-overlay').fadeOut(function(){
				$(this).remove();
				$theWidget.removeClass('widget-focus-enabled');
			}); 			
		}
	);

	/************************
	/*	WINDOW RESIZE
	/************************/

	$(window).bind("resize", resizeResponse);

	function resizeResponse() { 		

		if( $(window).width() < (992-15)) {
			if( $('.left-sidebar').hasClass('minified') ) {
				$('.left-sidebar').removeClass('minified');
				$('.left-sidebar').addClass('init-minified');
			}

		

		}else {
			if( $('.left-sidebar').hasClass('init-minified') ) {
				$('.left-sidebar')
				.removeClass('init-minified')
				.addClass('minified');
			}
		}

		// inbox left menu
		if( $(window).width() > (768-15)) {			
			$('.inbox-left-menu').css({
				display: 'initial',
				overflow: 'initial'
			});

		}else {
			$('.inbox-left-menu').css({
				display: 'none',
				overflow: 'hidden'
			});
		}					
	}

	/************************
	/*	BOOTSTRAP TOOLTIP
	/************************/
	
	$('body').tooltip({
      selector: "[data-toggle=tooltip]",
      container: "body"
    })

    /************************
	/*	BOOTSTRAP ALERT
	/************************/

	$('.alert .close').click( function(e){
		e.preventDefault();
		$(this).parents('.alert').fadeOut(300);
	});

	/************************
	/*	BOOTSTRAP POPOVER
	/************************/

	$('.btn-help').popover({
		container: 'body',
		placement: 'top',
		html: true,
		title: '<i class="fa fa-book"></i> Help',
		content: "Help summary goes here. Options can be passed via data attributes <code>data-</code> or JavaScript. Please check <a href='http://getbootstrap.com/javascript/#popovers'>Bootstrap Doc</a>"
	});

	$('.demo-popover1 #popover-title').popover({
		html: true,
		title: '<i class="fa fa-cogs"></i> Popover Title',
		content: 'This popover has title and support HTML content. Quickly implement process-centric networks rather than compelling potentialities. Objectively reinvent competitive technologies after high standards in process improvements. Phosfluorescently cultivate 24/365.'
	});

	$('.demo-popover1 #popover-hover').popover({
		html: true,
		title: '<i class="fa fa-cogs"></i> Popover Title',
		trigger: 'hover',
		content: 'Activate the popover on hover. Objectively enable optimal opportunities without market positioning expertise. Assertively optimize multidisciplinary benefits rather than holistic experiences. Credibly underwhelm real-time paradigms with.'
	});

	$('.demo-popover2 .btn').popover();
	

	/*****************************
	/*	WIDGET WITH AJAX ENABLE
	/*****************************/

	$('.widget-header-toolbar .btn-ajax').click( function(e){
		e.preventDefault();
		$theButton = $(this);

		$.ajax({
			url: 'php/widget-ajax.php',
			type: 'POST',
			dataType: 'json',
			cache: false,
			beforeSend: function(){
				$theButton.prop('disabled', true);
				$theButton.find('i').removeClass().addClass('fa fa-spinner fa-spin');
				$theButton.find('span').text('Loading...');
			},
			success: function( data, textStatus, XMLHttpRequest ) {
				
				setTimeout( function() {
					getResponseAction($theButton, data['msg'])
				}, 1000 );
				/* setTimeout is used for demo purpose only */

			},
			error: function( XMLHttpRequest, textStatus, errorThrown ) {
				console.log("AJAX ERROR: \n" + XMLHttpRequest.responseText);
			}
		});
	});
	
	function getResponseAction(theButton, msg){
		theButton = $('.widget-header-toolbar .btn-ajax')

		$('.widget-ajax .alert').removeClass('alert-info').addClass('alert-success')
		.find('span').text( msg );

		$('.widget-ajax .alert').find('i').removeClass().addClass('fa fa-check-circle');				

		theButton.prop('disabled', false);
		theButton.find('i').removeClass().addClass('fa fa-floppy-o');
		theButton.find('span').text('Update');
	}

	/**************************************
	/*	MULTISELECT/SINGLESELECT DROPDOWN
	/**************************************/

	if( $('.widget-header .multiselect').length > 0 ) {

		$('.widget-header .multiselect').multiselect({
			//buttonContainer: '<div class="btn-group-multiselect" />',
			dropRight: true,
			buttonClass: 'btn btn-warning btn-sm'
		});
	}

	//*******************************************
	/*	BOOTSTRAP TABBED NAV ON PAGE AND WIDGET
	/********************************************/

	if( $('.nav.nav-tabs').length > 0 ) {
		$('.nav.nav-tabs a').click( function(e) {
			e.preventDefault();
			$(this).tab('show');
		});
	}

	if( $('.today-reminder').length > 0 ) {
		var count = 0;
		var timer;		
		var ringSound = new Audio();

		if ( navigator.userAgent.match("Firefox/") ) {
			ringSound.src = "assets/audio/bell-ringing.ogg";
		}else {
			ringSound.src = "assets/audio/bell-ringing.mp3";	
		}
		
		function ringIt() {
			if( count < 3)	{ // adjust it with the css ring animation at .today-reminder				
				ringSound.play();
				timer = setTimeout( ringIt, 8000); // adjust it with the css ring animation at .today-reminder
				count++;
			}
		}

		ringIt();
		
	}
	
	//*******************************************
	/*	SWITCH INIT
	/********************************************/
	if( $('.bs-switch').length > 0 ) {
		$('.bs-switch').bootstrapSwitch();	
	}

	/* main content has min-height = left sidebar height */
	$('.content-wrapper').css('min-height', $('.left-sidebar').height());

});
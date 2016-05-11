$(function() {
	expandables();
	tabs();

	if ( !Modernizr.touchevents ) {
	  customSelects();
	}

	$('.nav-trigger').click(function(e) {
		e.preventDefault();
		menu();
	});

	$('.overly').click(function() {
    toggleModal();
  });

  $('.box').click(function(e) {
    e.stopPropagation();
  });

  $('.overly-close-trigger').click(function(e) {
    e.preventDefault();

    toggleModal();
  });

  $(this).keyup(function(e) {
    if (e.keyCode == 27) {
      toggleModal();
    }
  });
});
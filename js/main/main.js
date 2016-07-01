$(function() {
	expandables();
	tabs();
	
	if ( !Modernizr.touchevents ) {
	  customSelects();
	}
	
  $(".menu-item-has-children").each(function() {
    var $this = $(this),
        $trigger = $this.find("> a");

    $trigger.click(function(e) {
      e.preventDefault();
      e.stopPropagation();

      $this.toggleClass('active');
    });
  });
	
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
  
  $('body').click(function(e) {
    e.stopPropagation();

    $('.menu-item-has-children').removeClass('active');
  });
});

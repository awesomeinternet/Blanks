function menu() {
	if ( $('nav').hasClass('visible') ) {
		$('nav').removeClass('visible');
		$('.nav-trigger').removeClass('active');
	} else {
		$('nav').addClass('visible');
		$('.nav-trigger').addClass('active');
	}
}

function toggleModal(id) {
	$overly = $('.overly');

	if ( id != undefined ) {
		var $modal = $(id);

		if ( $overly.hasClass('visible') ) {
			$overly.find('.box').hide();
			$modal.show();
		} else {
			$overly.addClass('visible').fadeIn('fast', function() {
				$modal.show();
			});
		}
	} else {
		$overly.removeClass('visible').fadeOut('fast', function() {
			$overly.find('.box').hide();
		});
	}
}

function tabs() {
	var $tabsNav = $(".tabs-nav a"),
			$tabs = $(".tab");

	$tabsNav.first().addClass('active');
	$tabs.hide().first().show();

	$tabsNav.click(function(e) {
		e.preventDefault();

		var $target = $( $(this).attr('href') );

		$tabsNav.removeClass('active');
		$(this).addClass('active');

		$tabs.hide();
		$target.fadeIn('fast');
	})
}

function expandables() {
	var $expandables = $(".expandable");

	$expandables.each(function() {
		var $this = $(this);

		$this.find('.expandable-content').hide();

		$this.find('.expandable-trigger').click(function(e) {
			e.preventDefault();

			if ( $(this).hasClass('active') ) {
				$(this).removeClass('active');
				$(this).find('i').removeClass('fa-minus').addClass('fa-plus');
			} else {
				$(this).addClass('active');
				$(this).find('i').removeClass('fa-plus').addClass('fa-minus');
			}

			$this.find('.expandable-content').slideToggle();
		});
	});
}

function customSelects() {
  var $selectWrappers = $('.select-wrapper');

  $selectWrappers.each(function() {
    var $this = $(this),
        $nativeSelect = $(this).find('select'),
        selectOptions = [];
        label = $nativeSelect.data("label");

    $nativeSelect.find('option').each(function() {
    	var optionArray = [ $(this).text(), $(this).val()];

    	selectOptions.push( optionArray );
    });

    var $select = createSelect(label, selectOptions);

    $this.append($select);

    $select.each(function() {

    	$(this).click(function() {
				$(this).find('.options').fadeToggle('fast');
				$(this).toggleClass('active');
    	});

	    var $options = $(this).find('.option'),
	    		$visor = $(this).find('.visor');

	    $options.click(function() {
	    	$nativeSelect.val( $(this).data("value") ).trigger('change');
	    	$visor.text( $(this).text() );
	    });
    });
  });

  function createSelect(label, options) {
		var $select = $("<div />").attr({ class: "select"}),
				$options = $("<div />").attr({ class: "options"});

		$select.append("<div class='visor'>"+ label +"</div>");
		$select.append("<span class='indicator'><i class='fa fa-caret-down'></i></span>");

		for (var i = 0; i <= options.length - 1; i++) {
			var label = options[i][0],
					val = options[i][1];

			var option = $("<div />").attr({
				class: "option",
				"data-value": val
			}).text(label);

			$options.append(option);
		};
		$select.append($options);
		$options.hide();

		return $select;
  }
}

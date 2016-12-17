jQuery(document).ready(function($) {
	
	$('.flickity-gallery').flickity({
		// options
		cellAlign: 'center',
		contain: false,
		wrapAround: true,
		freeScroll: true
	});
	
	var filterValue = '';
	var isotopeOptions = {
		itemSelector: '.app',
		layoutMode: 'masonry',
		masonry: {
		  columnWidth: '.grid-sizer',
		  gutter: '.gutter-sizer',
		},
		percentPosition: true,
		transitionDuration: '0.4s',
		filter: filterValue
	};
	$('.apps-directory').isotope(isotopeOptions);
	
	//button filter
	$('.directory-filters .filter').on( 'click', function(e) {
		e.preventDefault();
		filterValue = $(this).attr('data-filter');
		
		//clear selects
		$('.directory-filters select.filter-group').val('.app');
		
		if( $(this).hasClass('active') ) {
			$(this).removeClass('active');
			$(this).parents('.filter-group').data('active', '' );
		}
		else {
			$(this).parents('.filter-group').find('.filter').removeClass('active');
			$(this).addClass('active');
			$(this).parents('.filter-group').data('active', filterValue );
		}
		if ( $('.filter.active').length === 0 ) {
			//reset to show all
			filterValue = '.app';
		}
		else if ( $('.filter.active').length >= 1 ) {
			filterValue = '';
			//get all active filters and combine into one filter.
			$('.filter.active').each( function(){
				filterValue += $(this).attr('data-filter');
			});
		}
		
		// console.log(filterValue);
		
		$('.apps-directory').isotope({ 
			filter: filterValue 
		});
	});
	
	//select option controller
	$('.directory-filters select.filter-group').on('change blur click', function(e){
		e.preventDefault();
		
		$('.filter-group .filter').removeClass('active');
		
		filterValue = $(this).val();
		
		$('.apps-directory').isotope({ 
			filter: filterValue 
		});
	});
	
	$('#option_view').on('change blur click', function(){
		$('.apps-directory').attr('class', 'apps-directory ' + $(this).val() );
		$('.apps-directory').isotope();
	});
		
});
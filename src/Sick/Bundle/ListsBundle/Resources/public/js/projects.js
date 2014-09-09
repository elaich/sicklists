$(document).ready(function(){
	// resizing the left menu with the window
	$(window).resize(function(){
		var height = $(window).height();
		$('#left-menu').height(height);
	});

	// hide the form for adding a project
	$('#add-project .cancel').click(function(ev){
		ev.preventDefault();
		$('#add-project form').hide('slow');
	});

	// show the form for adding a project
	$('#add-project-link').click(function(ev){
		ev.preventDefault();
		$('#add-project form').show('slow');
	});

	// click on project list item trigger click on link
	$('.projects li').click(function(ev){
		$(this).find('a').each(function(i, el){
			el.click();
		});
	});

});

jQuery(document).ready( function($){
	var isopen = false;
	var category = '';
	var caticon = '';
	
	$('.js-icon-picker-close').on('click', function(){		
		$('.blogastic-fa-icon-picker').toggle();
		isopen = false;
		icon = $(this).data('icon');
		if (icon && category) {
			caticon.removeClass();
			caticon.addClass('fa fa-'+icon+' admin-cat-icon js-icon-picker-open');
			caticon.parent().find('input').val(icon);
		}
	});
	
	$('.js-icon-picker-open').on('click', function(){
		if(!isopen){
			caticon = $(this);
			category = $(this).data('category');
			isopen = true;
			setIconPickerPosition();
		}else{
			isopen = false;	
			category = '';	
			caticon = '';			
		}
		$('.blogastic-fa-icon-picker').toggle();
	});
	
	function setIconPickerPosition(){
		var tbodyposition = $("#wpbody-content").position();
		var seliconposition = caticon.position();
		var top = seliconposition.top - tbodyposition.top;
		var left = 40 + seliconposition.left - tbodyposition.left;
		$('.blogastic-fa-icon-picker').css({
			"top":top,
			"left":left 
		});
	}
	
});
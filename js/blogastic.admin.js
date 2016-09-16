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
	
	
	
	var mediaUploader;
	
	$('#upload-button').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader ){
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Profile Picture',
			button: {
				text: 'Choose Picture'
			},
			multiple: false
		});
		
		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#profile-picture').val(attachment.url);
			$('#profile-picture-preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader.open();
		
	});
	
	$('#remove-picture').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove your Profile Picture?");
		if( answer == true ){
			$('#profile-picture').val('');
			$('.blogastic-general-form').submit();
		}
		return;
	});
	
});
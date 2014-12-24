jQuery(document).ready(function($) {

	/* scrollbar */
	$("aside").mCustomScrollbar({
		scrollButtons:{
			enable:true
		}	
	});

	/* tooltip */
	$('.hastip').tooltip({
		'placement' : 'bottom'
	});

	$('#change_tree_state input').mousedown(function(){
		$('#change_tree_state').submit();
	});	

	$('.submit_onchange').change(function(){
		$(this).submit();
	})

	var i = $('#number_maps').attr("value");

	$('#add_map').click(function(){
		i++;
		$(this).after('<br> <input type="text" name="map_name_'+i+'" placeholder="name of map"> <input type="text" name="map_url_'+i+'" placeholder="http://"><br>');
		$("#number_maps").attr("value", i);
	});

	$('.delete_map').click(function(){
		$(this).parent('.map').remove();
		return false;
	});

	$('#edit_tree form').change(function(){
		if($('#update_onchange').attr("value") == 1)
		{
			$('#edit_tree form').submit();
		}
	});

});
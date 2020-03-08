var lat;
var long;

function initialize() {

	var myLatlng = new google.maps.LatLng(lat, long);
	var myOptions = {
		zoom: 15,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	$('#map_canvas').fadeOut(100, function() {
		
		var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
		
		var marker = new google.maps.Marker({
			position: myLatlng
		});
		
		marker.setMap(map);
		$(this).fadeIn(100);
		
	});

}


$(document).ready(function() {
	$('#buscador_gmpas').click(function() {
		var pc = $('#post_code').val();
		if (pc != '') {
			$.getJSON('../php/buscador_coordenadas.php?pc='+pc, function(data) {
				lat = data.results[0].geometry.location.lat;
				long = data.results[0].geometry.location.lng;
				$('#result').html('<input type="hidden" name="lat_propiedad" value="'+lat+'" />'+'<input type="hidden" name="long_propiedad" value="'+long+'" />');
				$.getScript('http://maps.google.com/maps/api/js?sensor=false&callback=initialize');
			});
		}
		return false;
	});
});
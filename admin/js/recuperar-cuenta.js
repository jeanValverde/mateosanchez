$("#form-recuperar-cuenta").submit(function(){
	
	var validar_datos = true;
	
	if(!$("input#correo_cuenta").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,10}[.][a-zA-Z]{2,4}$/)){
		$("input#correo_cuenta").addClass('has-error');
		validar_datos = false;
	}
	
	if(validar_datos != true){
		event.preventDefault();
	}
});

$("#form-recuperar-cuenta :input").keyup(function(){
	
	if($("input#correo_cuenta").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,10}[.][a-zA-Z]{2,4}$/)){
		$("input#correo_cuenta").removeClass('has-error');
	}
});
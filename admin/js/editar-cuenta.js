$("#form-cambiar-cuenta").submit(function(){
	
	var validar_datos = true;
	
	if($("input#clave_nueva").val() != "" || $("input#clave_repetida").val() != ""){
		if(!$("input#clave_nueva").val().match(/^[a-z0-9.,]{6,16}$/)){
			$("input#clave_nueva").addClass('has-error');
			validar_datos = false;
		}
		
		if(!$("input#clave_repetida").val().match(/^[a-z0-9.,]{6,16}$/)){
			$("input#clave_repetida").addClass('has-error');
			validar_datos = false;
		}
		
		if($("input#clave_nueva").val() != $("input#clave_repetida").val()){
			$("input#clave_repetida").addClass('has-error');
			validar_datos = false;
		}
	}
	
	if(!$("input#clave_cuenta").val().match(/^[a-z0-9.,]{6,16}$/)){
		$("input#clave_cuenta").addClass('has-error');
		validar_datos = false;
	}
	
	if(!$("input#nombre_persona").val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]{4,50}$/)){
		$("input#nombre_persona").addClass('has-error');
		validar_datos = false;
	}
	
	if(!$("input#telefono_persona").val().match(/^[0-9-()+]{3,20}/)){
		$("input#telefono_persona").addClass('has-error');
		validar_datos = false;
	}
	
	if(!$("input#correo_cuenta").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,10}[.][a-zA-Z]{2,4}$/)){
		$("input#correo_cuenta").addClass('has-error');
		validar_datos = false;
	}
	
	if(validar_datos != true){
		event.preventDefault();
	}
});

$("#form-cambiar-cuenta :input").keyup(function(){
	
	if($("input#clave_nueva").val().match(/^[a-z0-9.,]{6,16}$/)){
		$("input#clave_nueva").removeClass('has-error');
	}
	
	if($("input#clave_repetida").val().match(/^[a-z0-9.,]{6,16}$/)){
		$("input#clave_repetida").removeClass('has-error');
	}
	
	if($("input#clave_nueva").val() == "" && $("input#clave_repetida").val() == ""){
		$("input#clave_nueva").removeClass('has-error');
		$("input#clave_repetida").removeClass('has-error');
	}
	
	if($("input#clave_cuenta").val().match(/^[a-z0-9.,]{6,16}$/)){
		$("input#clave_cuenta").removeClass('has-error');
	}
	
	if($("input#nombre_persona").val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]{4,50}$/)){
		$("input#nombre_persona").removeClass('has-error');
	}
	
	if($("input#correo_cuenta").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,10}[.][a-zA-Z]{2,4}$/)){
		$("input#correo_cuenta").removeClass('has-error');
	}
	
	if($("input#telefono_persona").val().match(/^[0-9-()+]{3,20}/)){
		$("input#telefono_persona").removeClass('has-error');
	}
});
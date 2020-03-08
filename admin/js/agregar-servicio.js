$("#form-agregar-servicio").submit(function(){
	var validar_datos = true;
	
	if(!$("input#nombre_servicio").val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9.,-_\s]{4,50}$/)){
		$("input#nombre_servicio").addClass('has-error');
		validar_datos = false;
	}
	
	if(!$("input#valor_minimo_servicio").val().match(/^[0-9]{1,20}/)){
		$("input#valor_minimo_servicio").addClass('has-error');
		validar_datos = false;
	}
	
	if($("select#id_tipo_servicio").val() == "-"){
		$("select#id_tipo_servicio").addClass('has-error');
		validar_datos = false;
	}
	
	if(validar_datos != true){
		event.preventDefault();
	}
});

$("#form-recuperar-cuenta :input").keyup(function(){
	
	if($("input#nombre_servicio").val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9.,-_\s]{4,50}$/)){
		$("input#nombre_servicio").removeClass('has-error');
	}
	
	if($("input#valor_minimo_servicio").val().match(/^[0-9]{1,20}/)){
		$("input#valor_minimo_servicio").removeClass('has-error');
	}
});

$("select#id_tipo_servicio").change(function(){
	$("select#id_tipo_servicio").removeClass('has-error');
});
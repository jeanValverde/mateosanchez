$("#form-agregar-franquicia").submit(function(){	
	var nombre_franquicia = $("input#nombre_franquicia").val();
	var id_region = $("select#id_region").val();
	var id_comuna = $("select#id_comuna").val();
	var direccion_franquicia = $("input#direccion_franquicia").val();
	var telefono_fijo_franquicia = $("input#telefono_fijo_franquicia").val();
	var telefono_movil_franquicia = $("input#telefono_movil_franquicia").val();
	var correo_franquicia = $("input#correo_franquicia").val();
	var representante_franquicia = $("input#representante_franquicia").val();
	var fono_contacto_representante = $("input#fono_contacto_representante").val();
	
	var mensaje_error = "";
	
	if(nombre_franquicia == ""){
		mensaje_error += "Falta dato: Nombre de la Franquicia.\n";
	}
	
	if(id_region == "-"){
		mensaje_error += "Falta dato: Region.\n";
	}
	
	if(id_comuna == "-"){
		mensaje_error += "Falta dato: Comuna.\n";
	}
	
	if(direccion_franquicia == ""){
		mensaje_error += "Falta dato: Direccion de la Franquicia.\n";
	}
	
	if(!telefono_movil_franquicia.match(/^[0-9-()+]{3,20}/)){
		mensaje_error += "Falta dato: Telefono Movil Franquicia.\n";
	}
	
	//if(!correo_franquicia == ""){
	//	mensaje_error += "Falta dato: Correo electronico de la Franquicia.\n";
	//}
	
	if(representante_franquicia == ""){
		mensaje_error += "Falta dato: Nombre del representante.\n";
	}
	
	if(!fono_contacto_representante.match(/^[0-9-()+]{3,20}/)){
		mensaje_error += "Falta dato: Telefono contacto del representante.\n";
	}
	
	if(mensaje_error != ""){
		alert(mensaje_error);
		event.preventDefault();
	}
});
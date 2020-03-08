$("#form-agregar-propiedad").submit(function(){	
	var validar = true;
	var mensaje_error = "";
	
	if($("#observaciones_propietario").val() == ""){
		validar = false;
		mensaje_error += "Ingrese informacion a las observaciones del propietario.\n";
	}
	
	//if($("#is_fail_rol").val() == "1"){
	//	validar = false;
	//	mensaje_error += "Ingrese el rol valido para la propiedad.\n";
	//}
	
	if($("input:radio[name=id_tipo_codigo]:checked").val() == "2" && $("#cod_propiedad_documento").val() == ""){
		validar = false;
		mensaje_error += "Ingrese codigo de la propiedad si sera en papel.\n";
	}
	
	if($("is_fail_codigo").val() == "1"){
		validar = false;
		mensaje_error += "Ingrese codigo de la propiedad no valido.\n";
	}
	
	if($("#id_tipo_operacion").val() == "-"){
		validar = false;
		mensaje_error += "Ingrese el tipo de operacion de la propiedad.\n";
	}
	
	if($("#id_tipo_propiedad").val() == "-"){
		validar = false;
		mensaje_error += "Ingrese el tipo de propiedad.\n";
	}
	
	if($("#id_comuna").val() == "-"){
		validar = false;
		mensaje_error += "Ingrese la comuna en la que se encuentra esta propiedad.\n";
	}
	
	if($("#direccion_propiedad").val() == ""){
		validar = false;
		mensaje_error += "Ingrese la direccion de la propiedad.\n";
	}
	
	if($("#valor").val() == ""){
		validar = false;
		mensaje_error += "Ingrese el valor de la propiedad.\n";
	}
	
	if($("#dormitorios_propiedad").val() == ""){
		validar = false;
		mensaje_error += "Ingrese el numero de propiedades de la propiedad.\n";
	}
	
	if($("#banos_propiedad").val() == ""){
		validar = false;
		mensaje_error += "Ingrese el numero de ba\u00f1os de la propiedad.\n";
	}
	
	if($("#nro_estacionamiento").val() == ""){
		validar = false;
		mensaje_error += "Ingrese el numero de estacionamientos de la propiedad.\n";
	}
	
	if($("#nro_bodega").val() == ""){
		validar = false;
		mensaje_error += "Ingrese el numero de bodegas de la propiedad.\n";
	}
	
	if($("#cantidad_superficie_total_propiedad").val() == ""){
		validar = false;
		mensaje_error += "Ingrese la superficie total de la propiedad.\n";
	}
	
	if($("#cantidad_superficie_construida_propiedad").val() == ""){
		validar = false;
		mensaje_error += "Ingrese la superficie construida de la propiedad.\n";
	}
	
	if($("#id_unidad_medida").val() == "-"){
		validar = false;
		mensaje_error += "Ingrese que tipo de medida se usa para las superficies.\n";
	}
	
	if($("#detalle_propiedad").val() == ""){
		validar = false;
		mensaje_error += "Ingrese el detalle de la propiedad.\n";
	}
	
	if($("#img_01_propiedad").val() != ""){
		var iSize = ($("#img_01_propiedad")[0].files[0].size / 1024);
		iSize = (Math.round((iSize / 1024) * 100) / 100);
		
		if(iSize > 6){
			validar = false;
			mensaje_error += "Imagen nro 01 exede los 6 Mb.\n";
		}
	}
	
	if($("#img_02_propiedad").val() != ""){
		var iSize = ($("#img_02_propiedad")[0].files[0].size / 1024);
		iSize = (Math.round((iSize / 1024) * 100) / 100);
		
		if(iSize > 6){
			validar = false;
			mensaje_error += "Imagen nro 02 exede los 6 Mb.\n";
		}
	}
	
	if($("#img_03_propiedad").val() != ""){
		var iSize = ($("#img_03_propiedad")[0].files[0].size / 1024);
		iSize = (Math.round((iSize / 1024) * 100) / 100);
		
		if(iSize > 6){
			validar = false;
			mensaje_error += "Imagen nro 03 exede los 6 Mb.\n";
		}
	}
	
	if($("#img_04_propiedad").val() != ""){
		var iSize = ($("#img_04_propiedad")[0].files[0].size / 1024);
		iSize = (Math.round((iSize / 1024) * 100) / 100);
		
		if(iSize > 6){
			validar = false;
			mensaje_error += "Imagen nro 04 exede los 6 Mb.\n";
		}
	}
	
	if(validar == false){
		alert(mensaje_error);
		event.preventDefault();
	}
});

$("#rol_propiedad").keyup(function(){
	$.ajax({
		url: "../php/validar_rol.php",
		type: "POST",
		data: {
			rol_propiedad:$(this).val()
		},
		cache: false,
		success: function(response) {
			if(response == "S"){
				$("#validar-rol").removeClass("has-error");
				$("#validar-rol").addClass("has-success");
				$("#resultado-validar-rol").html("Rol valido");
				$("#is_fail_rol").val("0");
			}else if(response == "E"){
				$("#validar-rol").addClass("has-error");
				$("#validar-rol").removeClass("has-success");
				$("#resultado-validar-rol").html("Rol no valido");
				$("#is_fail_rol").val("1");
			}else{
				$("#validar-rol").removeClass("has-error");
				$("#validar-rol").removeClass("has-success");
				$("#resultado-validar-rol").html("Validar rol");
				$("#is_fail_rol").val("1");
			}
		},
	})
	
});

$("#cod_propiedad_documento").keyup(function(){
	$.ajax({
		url: "../php/validar_codigo_propiedad.php",
		type: "POST",
		data: {
			cod_propiedad:$(this).val()
		},
		cache: false,
		success: function(response) {
			if(response == "S"){
				$("#validar_codigo").removeClass("has-error");
				$("#validar_codigo").addClass("has-success");
				$("#resultado-validar-codigo").html("Codigo valido");
				$("#is_fail_codigo").val("0");
			}else if(response == "E"){
				$("#validar_codigo").addClass("has-error");
				$("#validar_codigo").removeClass("has-success");
				$("#resultado-validar-codigo").html("Codigo no valido");
				$("#is_fail_codigo").val("1");
			}else{
				$("#validar_codigo").removeClass("has-error");
				$("#validar_codigo").removeClass("has-success");
				$("#resultado-validar-codigo").html("Validar Codigo");
				$("#is_fail_codigo").val("0");
			}
		},
	})
	
});

$(document).ready(function() {

	$('#form-agregar-propiedad').keypress(function(e){   
		if(e == 13){
		  return false;
		}
	});

	$('input').keypress(function(e){
		if(e.which == 13){
		  return false;
		}
	});

});
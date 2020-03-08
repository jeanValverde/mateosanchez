<?php
	session_start();
	require_once("rutinas.php");
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	$is_fail = 0; //iniciador del indicador si hubo algun fallo durante el proceso, 0->No; 1->Si
	$is_test = 0; //indicador si esta en formato de pruebas, 0->No; 1->Si
	$_SESSION["mensaje-sistema"] = ""; //Inicializar el mensaje del sistema para adherir errores o exitos
	
	//Se valida si vienen los datos necesarios para el proceso
	if(isset($_GET["id_peticion"])){
		//Se valida que la persona que esta realizando el proceso sea la misma persona que entro al sistema
		
		//Se actualiza el registro segun el valor generado anteriormente
		$sql = "UPDATE peticiones SET";
		$sql .= " is_close = '1'";
		$sql .= " WHERE id_peticion = ".$_GET["id_peticion"];
		
		if($is_test == 1){
			echo "El codigo SQL es: ".$sql."<br />";
		}
		
		if($is_test == 0){
			$modifica = $conexion->prepare($sql);
			$modifica->execute();
		}
		
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Proceso terminado con exito.</div>";
		
	}else{
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Problema con la asignaci&oacute;n de la propiedad favor intentar nuevamente.</div>";
	}
	
	header("location: ../pages/ver-avisos.php");//Entrada a la pagina sin el formulario correspondiente.
?>
<?php
	session_start();
	require_once('../admin/php/rutinas.php');
	$message = "Buenas, este mensaje fue creado con el formulario de pedidos de carteles integrado a el sistema mateosanchez.cl - viene con el siguiente pedido: \n";
	date_default_timezone_set("America/Santiago");
	$fecha_peticion = date("Y-m-d G:i:s");
	$is_test = 0;
	
	
	//Bloque adhesivo efecto espejo
	if(isset($_POST["adhesivo_efecto_espejo_vertical"]) && $_POST["adhesivo_efecto_espejo_vertical"] == 1){
		
		//Bloque arrendó
		if(isset($_POST["adhesivo_efecto_espejo_vertical_chico_arrendo"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_chico_arrendo"]) && $_POST["adhesivo_efecto_espejo_vertical_chico_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto espejo [CHICO (35x43 cm) - VERTICAL - ARRENDO]: ".$_POST["adhesivo_efecto_espejo_vertical_chico_arrendo"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_mediano_arrendo"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_mediano_arrendo"]) && $_POST["adhesivo_efecto_espejo_vertical_mediano_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto espejo [MEDIANO (50x62 cm) - VERTICAL - ARRENDO]: ".$_POST["adhesivo_efecto_espejo_vertical_mediano_arrendo"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_grande_arrendo"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_grande_arrendo"]) && $_POST["adhesivo_efecto_espejo_vertical_grande_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto espejo [GRANDE (65x80 cm) - VERTICAL - ARRENDO]: ".$_POST["adhesivo_efecto_espejo_vertical_grande_arrendo"]."\n";
		}
		
		//Bloque vendió
		if(isset($_POST["adhesivo_efecto_espejo_vertical_chico_vendio"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_chico_vendio"]) && $_POST["adhesivo_efecto_espejo_vertical_chico_vendio"] > 0){
			$message .= "Letreros adhesivo efecto espejo [CHICO (35x43 cm) - VERTICAL - VENDIO]: ".$_POST["adhesivo_efecto_espejo_vertical_chico_vendio"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_mediano_vendio"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_mediano_vendio"]) && $_POST["adhesivo_efecto_espejo_vertical_mediano_vendio"] > 0){
			$message .= "Letreros adhesivo efecto espejo [MEDIANO (50x62 cm) - VERTICAL - VENDIO]: ".$_POST["adhesivo_efecto_espejo_vertical_mediano_vendio"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_grande_vendio"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_grande_vendio"]) && $_POST["adhesivo_efecto_espejo_vertical_grande_vendio"] > 0){
			$message .= "Letreros adhesivo efecto espejo [GRANDE (65x80 cm) - VERTICAL - VENDIO]: ".$_POST["adhesivo_efecto_espejo_vertical_grande_vendio"]."\n";
		}
		
		//Bloque arrienda
		if(isset($_POST["adhesivo_efecto_espejo_vertical_chico_arrienda"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_chico_arrienda"]) && $_POST["adhesivo_efecto_espejo_vertical_chico_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto espejo [CHICO (35x43 cm) - VERTICAL - ARRIENDA]: ".$_POST["adhesivo_efecto_espejo_vertical_chico_arrienda"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_mediano_arrienda"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_mediano_arrienda"]) && $_POST["adhesivo_efecto_espejo_vertical_mediano_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto espejo [MEDIANO (50x62 cm) - VERTICAL - ARRIENDA]: ".$_POST["adhesivo_efecto_espejo_vertical_mediano_arrienda"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_grande_arrienda"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_grande_arrienda"]) && $_POST["adhesivo_efecto_espejo_vertical_grande_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto espejo [GRANDE (65x80 cm) - VERTICAL - ARRIENDA]: ".$_POST["adhesivo_efecto_espejo_vertical_grande_arrienda"]."\n";
		}
		
		//Bloque vende
		if(isset($_POST["adhesivo_efecto_espejo_vertical_chico_vende"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_chico_vende"]) && $_POST["adhesivo_efecto_espejo_vertical_chico_vende"] > 0){
			$message .= "Letreros adhesivo efecto espejo [CHICO (35x43 cm) - VERTICAL - VENDE]: ".$_POST["adhesivo_efecto_espejo_vertical_chico_vende"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_mediano_vende"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_mediano_vende"]) && $_POST["adhesivo_efecto_espejo_vertical_mediano_vende"] > 0){
			$message .= "Letreros adhesivo efecto espejo [MEDIANO (50x62 cm) - VERTICAL - VENDE]: ".$_POST["adhesivo_efecto_espejo_vertical_mediano_vende"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_espejo_vertical_grande_vende"]) && !empty($_POST["adhesivo_efecto_espejo_vertical_grande_vende"]) && $_POST["adhesivo_efecto_espejo_vertical_grande_vende"] > 0){
			$message .= "Letreros adhesivo efecto espejo [GRANDE (65x80 cm) - VERTICAL - VENDE]: ".$_POST["adhesivo_efecto_espejo_vertical_grande_vende"]."\n";
		}
	}
	
	//Bloque adhesivo efecto normal vertical
	if(isset($_POST["adhesivo_efecto_normal_vertical"]) && $_POST["adhesivo_efecto_normal_vertical"] == 1){
		//Bloque arrendo
		if(isset($_POST["adhesivo_efecto_normal_vertical_chico_arrendo"]) && !empty($_POST["adhesivo_efecto_normal_vertical_chico_arrendo"]) && $_POST["adhesivo_efecto_normal_vertical_chico_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - VERTICAL - ARRENDO]: ".$_POST["adhesivo_efecto_normal_vertical_chico_arrendo"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_mediano_arrendo"]) && !empty($_POST["adhesivo_efecto_normal_vertical_mediano_arrendo"]) && $_POST["adhesivo_efecto_normal_vertical_mediano_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - VERTICAL - ARRENDO]: ".$_POST["adhesivo_efecto_normal_vertical_mediano_arrendo"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_grande_arrendo"]) && !empty($_POST["adhesivo_efecto_normal_vertical_grande_arrendo"]) && $_POST["adhesivo_efecto_normal_vertical_grande_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - VERTICAL - ARRENDO]: ".$_POST["adhesivo_efecto_normal_vertical_grande_arrendo"]."\n";
		}
		
		//Bloque vendio
		if(isset($_POST["adhesivo_efecto_normal_vertical_chico_vendio"]) && !empty($_POST["adhesivo_efecto_normal_vertical_chico_vendio"]) && $_POST["adhesivo_efecto_normal_vertical_chico_vendio"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - VERTICAL - VENDIO]: ".$_POST["adhesivo_efecto_normal_vertical_chico_vendio"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_mediano_vendio"]) && !empty($_POST["adhesivo_efecto_normal_vertical_mediano_vendio"]) && $_POST["adhesivo_efecto_normal_vertical_mediano_vendio"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - VERTICAL - VENDIO]: ".$_POST["adhesivo_efecto_normal_vertical_mediano_vendio"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_grande_vendio"]) && !empty($_POST["adhesivo_efecto_normal_vertical_grande_vendio"]) && $_POST["adhesivo_efecto_normal_vertical_grande_vendio"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - VERTICAL - VENDIO]: ".$_POST["adhesivo_efecto_normal_vertical_grande_vendio"]."\n";
		}
		
		//Bloque arrienda
		if(isset($_POST["adhesivo_efecto_normal_vertical_chico_arrienda"]) && !empty($_POST["adhesivo_efecto_normal_vertical_chico_arrienda"]) && $_POST["adhesivo_efecto_normal_vertical_chico_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - VERTICAL - ARRIENDA]: ".$_POST["adhesivo_efecto_normal_vertical_chico_arrienda"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_mediano_arrienda"]) && !empty($_POST["adhesivo_efecto_normal_vertical_mediano_arrienda"]) && $_POST["adhesivo_efecto_normal_vertical_mediano_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - VERTICAL - ARRIENDA]: ".$_POST["adhesivo_efecto_normal_vertical_mediano_arrienda"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_grande_arrienda"]) && !empty($_POST["adhesivo_efecto_normal_vertical_grande_arrienda"]) && $_POST["adhesivo_efecto_normal_vertical_grande_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - VERTICAL - ARRIENDA]: ".$_POST["adhesivo_efecto_normal_vertical_grande_arrienda"]."\n";
		}
		
		//Bloque vende
		if(isset($_POST["adhesivo_efecto_normal_vertical_chico_vende"]) && !empty($_POST["adhesivo_efecto_normal_vertical_chico_vende"]) && $_POST["adhesivo_efecto_normal_vertical_chico_vende"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - VERTICAL - VENDE]: ".$_POST["adhesivo_efecto_normal_vertical_chico_vende"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_mediano_vende"]) && !empty($_POST["adhesivo_efecto_normal_vertical_mediano_vende"]) && $_POST["adhesivo_efecto_normal_vertical_mediano_vende"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - VERTICAL - VENDE]: ".$_POST["adhesivo_efecto_normal_vertical_mediano_vende"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_vertical_grande_vende"]) && !empty($_POST["adhesivo_efecto_normal_vertical_grande_vende"]) && $_POST["adhesivo_efecto_normal_vertical_grande_vende"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - VERTICAL - VENDE]: ".$_POST["adhesivo_efecto_normal_vertical_grande_vende"]."\n";
		}
	}
	
	//Bloque adhesivo efecto normal horizontal
	if(isset($_POST["adhesivo_efecto_normal_horizontal"]) && $_POST["adhesivo_efecto_normal_horizontal"] == 1){
		//Bloque arrendo
		if(isset($_POST["adhesivo_efecto_normal_horizontal_chico_arrendo"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_chico_arrendo"]) && $_POST["adhesivo_efecto_normal_horizontal_chico_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - HORIZONTAL - ARRENDO]: ".$_POST["adhesivo_efecto_normal_horizontal_chico_arrendo"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_mediano_arrendo"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_mediano_arrendo"]) && $_POST["adhesivo_efecto_normal_horizontal_mediano_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - HORIZONTAL - ARRENDO]: ".$_POST["adhesivo_efecto_normal_horizontal_mediano_arrendo"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_grande_arrendo"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_grande_arrendo"]) && $_POST["adhesivo_efecto_normal_horizontal_grande_arrendo"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - HORIZONTAL - ARRENDO]: ".$_POST["adhesivo_efecto_normal_horizontal_grande_arrendo"]."\n";
		}
		
		//Bloque vendio
		if(isset($_POST["adhesivo_efecto_normal_horizontal_chico_vendio"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_chico_vendio"]) && $_POST["adhesivo_efecto_normal_horizontal_chico_vendio"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - HORIZONTAL - VENDIO]: ".$_POST["adhesivo_efecto_normal_horizontal_chico_vendio"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_mediano_vendio"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_mediano_vendio"]) && $_POST["adhesivo_efecto_normal_horizontal_mediano_vendio"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - HORIZONTAL - VENDIO]: ".$_POST["adhesivo_efecto_normal_horizontal_mediano_vendio"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_grande_vendio"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_grande_vendio"]) && $_POST["adhesivo_efecto_normal_horizontal_grande_vendio"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - HORIZONTAL - VENDIO]: ".$_POST["adhesivo_efecto_normal_horizontal_grande_vendio"]."\n";
		}
		
		//Bloque arrienda
		if(isset($_POST["adhesivo_efecto_normal_horizontal_chico_arrienda"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_chico_arrienda"]) && $_POST["adhesivo_efecto_normal_horizontal_chico_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["adhesivo_efecto_normal_horizontal_chico_arrienda"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_mediano_arrienda"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_mediano_arrienda"]) && $_POST["adhesivo_efecto_normal_horizontal_mediano_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["adhesivo_efecto_normal_horizontal_mediano_arrienda"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_grande_arrienda"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_grande_arrienda"]) && $_POST["adhesivo_efecto_normal_horizontal_grande_arrienda"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["adhesivo_efecto_normal_horizontal_grande_arrienda"]."\n";
		}
		
		//Bloque vende
		if(isset($_POST["adhesivo_efecto_normal_horizontal_chico_vende"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_chico_vende"]) && $_POST["adhesivo_efecto_normal_horizontal_chico_vende"] > 0){
			$message .= "Letreros adhesivo efecto normal [CHICO (35x43 cm) - HORIZONTAL - VENDE]: ".$_POST["adhesivo_efecto_normal_horizontal_chico_vende"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_mediano_vende"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_mediano_vende"]) && $_POST["adhesivo_efecto_normal_horizontal_mediano_vende"] > 0){
			$message .= "Letreros adhesivo efecto normal [MEDIANO (50x62 cm) - HORIZONTAL - VENDE]: ".$_POST["adhesivo_efecto_normal_horizontal_mediano_vende"]."\n";
		}
		
		if(isset($_POST["adhesivo_efecto_normal_horizontal_grande_vende"]) && !empty($_POST["adhesivo_efecto_normal_horizontal_grande_vende"]) && $_POST["adhesivo_efecto_normal_horizontal_grande_vende"] > 0){
			$message .= "Letreros adhesivo efecto normal [GRANDE (65x80 cm) - HORIZONTAL - VENDE]: ".$_POST["adhesivo_efecto_normal_horizontal_grande_vende"]."\n";
		}
	}
	
	//Bloque trovicel vertical
	if(isset($_POST["trovicel_vertical"]) && $_POST["trovicel_vertical"] == 1){
		//Bloque arrendo
		if(isset($_POST["trovicel_vertical_chico_arrendo"]) && !empty($_POST["trovicel_vertical_chico_arrendo"]) && $_POST["trovicel_vertical_chico_arrendo"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - VERTICAL - ARRENDO]: ".$_POST["trovicel_vertical_chico_arrendo"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_mediano_arrendo"]) && !empty($_POST["trovicel_vertical_mediano_arrendo"]) && $_POST["trovicel_vertical_mediano_arrendo"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - VERTICAL - ARRENDO]: ".$_POST["trovicel_vertical_mediano_arrendo"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_grande_arrendo"]) && !empty($_POST["trovicel_vertical_grande_arrendo"]) && $_POST["trovicel_vertical_grande_arrendo"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - VERTICAL - ARRENDO]: ".$_POST["trovicel_vertical_grande_arrendo"]."\n";
		}
		
		//Bloque vendio
		if(isset($_POST["trovicel_vertical_chico_vendio"]) && !empty($_POST["trovicel_vertical_chico_vendio"]) && $_POST["trovicel_vertical_chico_vendio"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - VERTICAL - VENDIO]: ".$_POST["trovicel_vertical_chico_vendio"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_mediano_vendio"]) && !empty($_POST["trovicel_vertical_mediano_vendio"]) && $_POST["trovicel_vertical_mediano_vendio"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - VERTICAL - VENDIO]: ".$_POST["trovicel_vertical_mediano_vendio"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_grande_vendio"]) && !empty($_POST["trovicel_vertical_grande_vendio"]) && $_POST["trovicel_vertical_grande_vendio"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - VERTICAL - VENDIO]: ".$_POST["trovicel_vertical_grande_vendio"]."\n";
		}
		
		//Bloque arrienda
		if(isset($_POST["trovicel_vertical_chico_arrienda"]) && !empty($_POST["trovicel_vertical_chico_arrienda"]) && $_POST["trovicel_vertical_chico_arrienda"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - VERTICAL - ARRIENDA]: ".$_POST["trovicel_vertical_chico_arrienda"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_mediano_arrienda"]) && !empty($_POST["trovicel_vertical_mediano_arrienda"]) && $_POST["trovicel_vertical_mediano_arrienda"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - VERTICAL - ARRIENDA]: ".$_POST["trovicel_vertical_mediano_arrienda"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_grande_arrienda"]) && !empty($_POST["trovicel_vertical_grande_arrienda"]) && $_POST["trovicel_vertical_grande_arrienda"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - VERTICAL - ARRIENDA]: ".$_POST["trovicel_vertical_grande_arrienda"]."\n";
		}
		
		//Bloque vende
		if(isset($_POST["trovicel_vertical_chico_vende"]) && !empty($_POST["trovicel_vertical_chico_vende"]) && $_POST["trovicel_vertical_chico_vende"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - VERTICAL - VENDE]: ".$_POST["trovicel_vertical_chico_vende"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_mediano_vende"]) && !empty($_POST["trovicel_vertical_mediano_vende"]) && $_POST["trovicel_vertical_mediano_vende"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - VERTICAL - VENDE]: ".$_POST["trovicel_vertical_mediano_vende"]."\n";
		}
		
		if(isset($_POST["trovicel_vertical_grande_vende"]) && !empty($_POST["trovicel_vertical_grande_vende"]) && $_POST["trovicel_vertical_grande_vende"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - VERTICAL - VENDE]: ".$_POST["trovicel_vertical_grande_vende"]."\n";
		}
	}
	
	//Bloque trovicel horizontal
	if(isset($_POST["trovicel_horizontal"]) && $_POST["trovicel_horizontal"] == 1){
		//Bloque arrendo
		if(isset($_POST["trovicel_horizontal_chico_arrendo"]) && !empty($_POST["trovicel_horizontal_chico_arrendo"]) && $_POST["trovicel_horizontal_chico_arrendo"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - HORIZONTAL - ARRENDO]: ".$_POST["trovicel_horizontal_chico_arrendo"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_mediano_arrendo"]) && !empty($_POST["trovicel_horizontal_mediano_arrendo"]) && $_POST["trovicel_horizontal_mediano_arrendo"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - HORIZONTAL - ARRENDO]: ".$_POST["trovicel_horizontal_mediano_arrendo"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_grande_arrendo"]) && !empty($_POST["trovicel_horizontal_grande_arrendo"]) && $_POST["trovicel_horizontal_grande_arrendo"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - HORIZONTAL - ARRENDO]: ".$_POST["trovicel_horizontal_grande_arrendo"]."\n";
		}
		
		//Bloque vendio
		if(isset($_POST["trovicel_horizontal_chico_vendio"]) && !empty($_POST["trovicel_horizontal_chico_vendio"]) && $_POST["trovicel_horizontal_chico_vendio"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - HORIZONTAL - VENDIO]: ".$_POST["trovicel_horizontal_chico_vendio"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_mediano_vendio"]) && !empty($_POST["trovicel_horizontal_mediano_vendio"]) && $_POST["trovicel_horizontal_mediano_vendio"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - HORIZONTAL - VENDIO]: ".$_POST["trovicel_horizontal_mediano_vendio"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_grande_vendio"]) && !empty($_POST["trovicel_horizontal_grande_vendio"]) && $_POST["trovicel_horizontal_grande_vendio"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - HORIZONTAL - VENDIO]: ".$_POST["trovicel_horizontal_grande_vendio"]."\n";
		}
		
		//Bloque arrienda
		if(isset($_POST["trovicel_horizontal_chico_arrienda"]) && !empty($_POST["trovicel_horizontal_chico_arrienda"]) && $_POST["trovicel_horizontal_chico_arrienda"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["trovicel_horizontal_chico_arrienda"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_mediano_arrienda"]) && !empty($_POST["trovicel_horizontal_mediano_arrienda"]) && $_POST["trovicel_horizontal_mediano_arrienda"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["trovicel_horizontal_mediano_arrienda"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_grande_arrienda"]) && !empty($_POST["trovicel_horizontal_grande_arrienda"]) && $_POST["trovicel_horizontal_grande_arrienda"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["trovicel_horizontal_grande_arrienda"]."\n";
		}
		
		//Bloque vende
		if(isset($_POST["trovicel_horizontal_chico_vende"]) && !empty($_POST["trovicel_horizontal_chico_vende"]) && $_POST["trovicel_horizontal_chico_vende"] > 0){
			$message .= "Letreros trovicel [CHICO (35x43 cm) - HORIZONTAL - VENDE]: ".$_POST["trovicel_horizontal_chico_vende"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_mediano_vende"]) && !empty($_POST["trovicel_horizontal_mediano_vende"]) && $_POST["trovicel_horizontal_mediano_vende"] > 0){
			$message .= "Letreros trovicel [MEDIANO (50x62 cm) - HORIZONTAL - VENDE]: ".$_POST["trovicel_horizontal_mediano_vende"]."\n";
		}
		
		if(isset($_POST["trovicel_horizontal_grande_vende"]) && !empty($_POST["trovicel_horizontal_grande_vende"]) && $_POST["trovicel_horizontal_grande_vende"] > 0){
			$message .= "Letreros trovicel [GRANDE (65x80 cm) - HORIZONTAL - VENDE: ".$_POST["trovicel_horizontal_grande_vende"]."\n";
		}
	}
	
	//Bloque tela pvc vertical
	if(isset($_POST["tela_pvc_vertical"]) && $_POST["tela_pvc_vertical"] == 1){
		//Bloque arrendo
		if(isset($_POST["tela_pvc_vertical_chico_arrendo"]) && !empty($_POST["tela_pvc_vertical_chico_arrendo"]) && $_POST["tela_pvc_vertical_chico_arrendo"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - VERTICAL - ARRENDO]: ".$_POST["tela_pvc_vertical_chico_arrendo"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_mediano_arrendo"]) && !empty($_POST["tela_pvc_vertical_mediano_arrendo"]) && $_POST["tela_pvc_vertical_mediano_arrendo"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - VERTICAL - ARRENDO]: ".$_POST["tela_pvc_vertical_mediano_arrendo"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_grande_arrendo"]) && !empty($_POST["tela_pvc_vertical_grande_arrendo"]) && $_POST["tela_pvc_vertical_grande_arrendo"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - VERTICAL - ARRENDO]: ".$_POST["tela_pvc_vertical_grande_arrendo"]."\n";
		}
		
		//Bloque vendio
		if(isset($_POST["tela_pvc_vertical_chico_vendio"]) && !empty($_POST["tela_pvc_vertical_chico_vendio"]) && $_POST["tela_pvc_vertical_chico_vendio"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - VERTICAL - VENDIO]: ".$_POST["tela_pvc_vertical_chico_vendio"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_mediano_vendio"]) && !empty($_POST["tela_pvc_vertical_mediano_vendio"]) && $_POST["tela_pvc_vertical_mediano_vendio"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - VERTICAL - VENDIO]: ".$_POST["tela_pvc_vertical_mediano_vendio"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_grande_vendio"]) && !empty($_POST["tela_pvc_vertical_grande_vendio"]) && $_POST["tela_pvc_vertical_grande_vendio"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - VERTICAL - VENDIO]: ".$_POST["tela_pvc_vertical_grande_vendio"]."\n";
		}
		
		//Bloque arrienda
		if(isset($_POST["tela_pvc_vertical_chico_arrienda"]) && !empty($_POST["tela_pvc_vertical_chico_arrienda"]) && $_POST["tela_pvc_vertical_chico_arrienda"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - VERTICAL - ARRIENDA]: ".$_POST["tela_pvc_vertical_chico_arrienda"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_mediano_arrienda"]) && !empty($_POST["tela_pvc_vertical_mediano_arrienda"]) && $_POST["tela_pvc_vertical_mediano_arrienda"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - VERTICAL - ARRIENDA]: ".$_POST["tela_pvc_vertical_mediano_arrienda"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_grande_arrienda"]) && !empty($_POST["tela_pvc_vertical_grande_arrienda"]) && $_POST["tela_pvc_vertical_grande_arrienda"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - VERTICAL - ARRIENDA]: ".$_POST["tela_pvc_vertical_grande_arrienda"]."\n";
		}
		
		//Bloque vende
		if(isset($_POST["tela_pvc_vertical_chico_vende"]) && !empty($_POST["tela_pvc_vertical_chico_vende"]) && $_POST["tela_pvc_vertical_chico_vende"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - VERTICAL - VENDE]: ".$_POST["tela_pvc_vertical_chico_vende"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_mediano_vende"]) && !empty($_POST["tela_pvc_vertical_mediano_vende"]) && $_POST["tela_pvc_vertical_mediano_vende"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - VERTICAL - VENDE]: ".$_POST["tela_pvc_vertical_mediano_vende"]."\n";
		}
		
		if(isset($_POST["tela_pvc_vertical_grande_vende"]) && !empty($_POST["tela_pvc_vertical_grande_vende"]) && $_POST["tela_pvc_vertical_grande_vende"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - VERTICAL - VENDE]: ".$_POST["tela_pvc_vertical_grande_vende"]."\n";
		}
	}
	
	//Bloque tela pvc horizontal
	if(isset($_POST["tela_pvc_horizontal"]) && $_POST["tela_pvc_horizontal"] == 1){
		//Bloque arrendo
		if(isset($_POST["tela_pvc_horizontal_chico_arrendo"]) && !empty($_POST["tela_pvc_horizontal_chico_arrendo"]) && $_POST["tela_pvc_horizontal_chico_arrendo"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - HORIZONTAL - ARRENDO]: ".$_POST["tela_pvc_horizontal_chico_arrendo"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_mediano_arrendo"]) && !empty($_POST["tela_pvc_horizontal_mediano_arrendo"]) && $_POST["tela_pvc_horizontal_mediano_arrendo"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - HORIZONTAL - ARRENDO]: ".$_POST["tela_pvc_horizontal_mediano_arrendo"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_grande_arrendo"]) && !empty($_POST["tela_pvc_horizontal_grande_arrendo"]) && $_POST["tela_pvc_horizontal_grande_arrendo"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - HORIZONTAL - ARRENDO]: ".$_POST["tela_pvc_horizontal_grande_arrendo"]."\n";
		}
		
		//Bloque vendio
		if(isset($_POST["tela_pvc_horizontal_chico_vendio"]) && !empty($_POST["tela_pvc_horizontal_chico_vendio"]) && $_POST["tela_pvc_horizontal_chico_vendio"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - HORIZONTAL - VENDIO]: ".$_POST["tela_pvc_horizontal_chico_vendio"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_mediano_vendio"]) && !empty($_POST["tela_pvc_horizontal_mediano_vendio"]) && $_POST["tela_pvc_horizontal_mediano_vendio"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - HORIZONTAL - VENDIO]: ".$_POST["tela_pvc_horizontal_mediano_vendio"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_grande_vendio"]) && !empty($_POST["tela_pvc_horizontal_grande_vendio"]) && $_POST["tela_pvc_horizontal_grande_vendio"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - HORIZONTAL - VENDIO]: ".$_POST["tela_pvc_horizontal_grande"]."\n";
		}
		
		//Bloque arrienda
		if(isset($_POST["tela_pvc_horizontal_chico_arrienda"]) && !empty($_POST["tela_pvc_horizontal_chico_arrienda"]) && $_POST["tela_pvc_horizontal_chico_arrienda"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["tela_pvc_horizontal_chico_arrienda"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_mediano_arrienda"]) && !empty($_POST["tela_pvc_horizontal_mediano_arrienda"]) && $_POST["tela_pvc_horizontal_mediano_arrienda"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["tela_pvc_horizontal_mediano_arrienda"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_grande_arrienda"]) && !empty($_POST["tela_pvc_horizontal_grande_arrienda"]) && $_POST["tela_pvc_horizontal_grande_arrienda"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - HORIZONTAL - ARRIENDA]: ".$_POST["tela_pvc_horizontal_grande_arrienda"]."\n";
		}
		
		//Bloque vende
		if(isset($_POST["tela_pvc_horizontal_chico_vende"]) && !empty($_POST["tela_pvc_horizontal_vende"]) && $_POST["tela_pvc_horizontal_chico_vende"] > 0){
			$message .= "Letreros tela PVC [CHICO (35x43 cm) - HORIZONTAL - VENDE]: ".$_POST["tela_pvc_horizontal_chico_vende"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_mediano_vende"]) && !empty($_POST["tela_pvc_horizontal_mediano_vende"]) && $_POST["tela_pvc_horizontal_mediano_vende"] > 0){
			$message .= "Letreros tela PVC [MEDIANO (50x62 cm) - HORIZONTAL - VENDE]: ".$_POST["tela_pvc_horizontal_mediano_vende"]."\n";
		}
		
		if(isset($_POST["tela_pvc_horizontal_grande_vende"]) && !empty($_POST["tela_pvc_horizontal_grande_vende"]) && $_POST["tela_pvc_horizontal_grande_vende"] > 0){
			$message .= "Letreros tela PVC [GRANDE (65x80 cm) - HORIZONTAL - VENDE]: ".$_POST["tela_pvc_horizontal_grande_vende"]."\n";
		}
	}
	
	if(isset($_POST["otras_peticiones"]) && !empty($_POST["otras_peticiones"])){
		$message .= "Otras peticiones: ".$_POST["otras_peticiones"]."\n";
	}
	
	if($is_test == 0){
		//Armamos la SQL para crear la nueva cuenta
		$sql = "INSERT INTO peticion_carteles ";
		$sql .= "(fecha_peticion_cartel, "; //:param_01
		$sql .= "detalle_peticion_cartel) "; //:param_02
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02)";
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $fecha_peticion);
		$inserta -> bindValue(':param_02', utf8_decode($message));
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
		
		//$to = "msanchez@mateosanchez.cl";
		$to = "ignacio.peralta@pcdstudio.cl, francisco.huerta@pcdstudio.cl, msanchez@mateosanchez.cl";
		$subject = "Peticion carteles hecha a traves del sitio mateosanchez.cl.";
		$from = "msanchez@mateosanchez.cl";
		$headers = "From: Mateo Sanchez <msanchez@mateosanchez.cl>\r\n";
		
		mail($to, $subject, $message, $headers);

		//require_once("../admin/php/class.phpmailer.php");
		//require_once("../admin/php/class.smtp.php");
		//
		//$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
		//try {
		//	$mail->SMTPDebug = 4;                               // Enable verbose debug output
		//	$mail->isSMTP();                                    // Set mailer to use SMTP
		//	$mail->SMTPDebug = false;
		//	$mail->do_debug = 0;
		//	$mail->Host = gethostbyname('mail.mateosanchez.cl'); 		// Specify main and backup SMTP servers
		//	$mail->SMTPAuth = true;                             // Enable SMTP authentication
		//	$mail->Username = 'no-reply@mateosanchez.cl';   // SMTP username
		//	$mail->Password = 'mateo.,123';                     // SMTP password
		//	$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
		//	$mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
		//	$mail->From = "msanchez@mateosanchez.cl";
		//	$mail->FromName = "Enviado por Mateo Sanchez";
		//	$mail->addAddress("ignacio.peralta@pcdstudio.cl", "Francisco Huerta Sistema");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
		//	$mail->addReplyTo("msanchez@mateosanchez.cl", "Mateo Sanchez Propiedades");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
		//	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		//	$mail->isHTML(false);                                  // Set email format to HTML
		//	$mail->Subject = $subject;
		//	$mail->Body    = nl2br($message);
		//	$mail->AltBody = 'Enviado por el sistema de propiedades mateosanchez.cl';
		//	if(!$mail->send()) {
		//		
		//		$_SESSION["mensaje-sistema"] = 'Error: ' . $mail->ErrorInfo;
		//	} else {
		//		$_SESSION["mensaje-sistema"] = 'Mensaje enviado con exito, lo contactaremos a la brevedad.';
		//	}
		//	$errors[] = "Send mail sucsessfully";
		//} catch (phpmailerException $e) {
		//	$errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
		//} catch (Exception $e) {
		//	$errors[] = $e->getMessage(); //Boring error messages from anything else!
		//}
		//
		//$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
		//try {
		//	$mail->SMTPDebug = 4;                               // Enable verbose debug output
		//	$mail->isSMTP();                                    // Set mailer to use SMTP
		//	$mail->SMTPDebug = false;
		//	$mail->do_debug = 0;
		//	$mail->Host = gethostbyname('mail.mateosanchez.cl'); 		// Specify main and backup SMTP servers
		//	$mail->SMTPAuth = true;                             // Enable SMTP authentication
		//	$mail->Username = 'no-reply@mateosanchez.cl';   // SMTP username
		//	$mail->Password = 'mateo.,123';                     // SMTP password
		//	$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
		//	$mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
		//	$mail->From = "msanchez@mateosanchez.cl";
		//	$mail->FromName = "Enviado por Mateo Sanchez";
		//	$mail->addAddress("msanchez@mateosanchez.cl", "Mateo Sanchez Propiedades");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
		//	$mail->addReplyTo("francisco.huerta@pcdstudio.cl", "Francisco Huerta Sistema");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
		//	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		//	$mail->isHTML(false);                                  // Set email format to HTML
		//	$mail->Subject = $subject;
		//	$mail->Body    = nl2br($message);
		//	$mail->AltBody = 'Enviado por el sistema de propiedades mateosanchez.cl';
		//	//if(!$mail->send()) {
		//	//	
		//	//	$_SESSION["mensaje-sistema"] = 'Error: ' . $mail->ErrorInfo;
		//	//} else {
		//	//	$_SESSION["mensaje-sistema"] = 'Mensaje enviado con exito, lo contactaremos a la brevedad.';
		//	//}
		//	//$errors[] = "Send mail sucsessfully";
		//} catch (phpmailerException $e) {
		//	$errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
		//} catch (Exception $e) {
		//	$errors[] = $e->getMessage(); //Boring error messages from anything else!
		//}
		
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Petici&oacute;n realizada nos contactaremos dentro de poco.</div>";
		
		header("location: cotizar-letreros.php");
	}else{
		echo $message;
	}
?>
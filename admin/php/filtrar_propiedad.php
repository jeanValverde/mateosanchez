<?php 
	require("rutinas.php"); 
	
	if(isset($_POST['id_franquicia'])){
		switch($_POST['id_franquicia']){
		case('-'):
		$sql ="select * from franquicias 
				INNER JOIN cuentas ON franquicias.id_franquicia = cuentas.id_franquicia 
				INNER JOIN propiedades ON cuentas.id_cuenta=propiedades.id_propiedad
				INNER JOIN tipo_propiedades on propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad
				INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion 
				INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna
				INNER JOIN sectores on propiedades.id_sector=sectores.id_sector
				INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor 
				;";
			echo $sql;
			break;
		case('1'):	
		$sql ="select * from franquicias 
				INNER JOIN cuentas ON franquicias.id_franquicia = cuentas.id_franquicia 
				INNER JOIN propiedades ON cuentas.id_cuenta=propiedades.id_propiedad
				INNER JOIN tipo_propiedades on propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad
				INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion 
				INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna
				INNER JOIN sectores on propiedades.id_sector=sectores.id_sector
				INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor 
				where franquicias.id_franquicia = ".$_POST['id_franquicia'].";";
			echo $sql;
			break;
		case('2'):
				$sql ="select * from franquicias 
				INNER JOIN cuentas ON franquicias.id_franquicia = cuentas.id_franquicia 
				INNER JOIN propiedades ON cuentas.id_cuenta=propiedades.id_propiedad
				INNER JOIN tipo_propiedades on propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad
				INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion 
				INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna
				INNER JOIN sectores on propiedades.id_sector=sectores.id_sector
				INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor 
				where franquicias.id_franquicia = ".$_POST['id_franquicia'].";";
			echo $sql;
			break;	
		}
	}
	
	$cursor_propiedad = $conexion -> query($sql);
	while($propiedad = $cursor_propiedad -> fetch()){//el error es porque te esta pasando el valor - en vez de un number
		?>
		<tr>
			<td><?php echo $propiedad["cod_propiedad"];?></td>
			<td><?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]);?></td>
			<td><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></td>
			<td><?php echo utf8_encode($propiedad["nombre_comuna"]);?></td>
			<td><?php echo utf8_encode($propiedad["nombre_sector"]);?></td>
			<td><?php echo $propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"]);?></td>
			<td><?php echo $propiedad["observacion_propietario"];?></td>
			<td><?php echo $propiedad["nombre_persona"];?></td>
			
			<td class="center">
				<a href="editar-propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-warning btn-xs expanded">Editar</a>
				<?php
				if($propiedad["is_hidden"] ==  0){
					?>
					<a href="../php/esconder_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-danger btn-xs expanded">Esconder</a>
					<?php
					if($propiedad["is_oferta"] ==  0){
					?>
					<a href="../php/ofertar_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-info btn-xs expanded">Oferta</a>
					<?php
					}else{
					?>
					<a href="../php/quitar_oferta_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-danger btn-xs expanded">Quitar oferta</a>
					<?php
					}
					?>
				<?php
				}else{
					?>
					<a href="../php/mostrar_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-info btn-xs expanded">Mostrar</a>
					<?php
					}
				?>
			</td>
		</tr>
		<?php
	}
?>
<?php
	session_start();
	require('rutinas.php');
?>
<div class="linea_propiedad">
	<div class="col-lg-1">
		<div class="form-group">
			<label>&nbsp;</label>
			<button type="button" class="btn btn-danger btn_quitar_linea_propiedad">Quitar</button>
		</div>
	</div>

	<div class="col-lg-2">
		<div class="form-group">
			<label>Tipo operaci&oacute;n</label>
			<select class="form-control id_tipo_operacion" name="id_tipo_operacion[]">
				<option value="-">Seleccione</option>
				<?php
				$sql_tipo_operacion = "SELECT * FROM tipo_operaciones ORDER BY nombre_tipo_operacion ASC";
				$cursor_tipo_operacion = $conexion -> query($sql_tipo_operacion);
				while($tipo_operacion = $cursor_tipo_operacion -> fetch()){
					?>
					<option value="<?php echo $tipo_operacion["id_tipo_operacion"]; ?>"><?php echo utf8_encode($tipo_operacion["nombre_tipo_operacion"]); ?></option>
					<?php
				}
				?>
			</select>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="form-group">
			<label>Direcci&oacute;n de la propiedad</label>
			<input type="text" class="form-control direccion_propiedad" name="direccion_propiedad[]">
		</div>
	</div>

	<div class="col-lg-2">
		<div class="form-group">
			<label>Sup. de la propiedad</label>
			<input type="text" class="form-control cantidad_superficie_construida_propiedad" name="cantidad_superficie_construida_propiedad[]">
		</div>
	</div>

	<div class="col-lg-2">
		<div class="form-group">
			<label>Valor propiedad</label>
			<input type="text" class="form-control valor_propiedad" name="valor_propiedad[]">
		</div>
	</div>

	<div class="col-lg-2">
		<div class="form-group">
			<label>Tipo de valor</label>
			<select class="form-control id_tipo_valor" name="id_tipo_valor[]">
				<?php
				$sql_tipo_valor = "SELECT * FROM tipo_valores ORDER BY nombre_tipo_valor ASC";
				$cursor_tipo_valor = $conexion -> query($sql_tipo_valor);
				while($tipo_valor = $cursor_tipo_valor -> fetch()){
					?>
					<option value="<?php echo $tipo_valor["id_tipo_valor"]; ?>"><?php echo $tipo_valor["nombre_tipo_valor"]; ?></option>
					<?php
				}
				?>
			</select>
		</div>
	</div>
</div>
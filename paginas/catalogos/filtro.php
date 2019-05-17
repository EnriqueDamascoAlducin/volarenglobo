<?php 
$usuarios=$cons->consultas("DISTINCT( CONCAT(nombre_usu,' ',apellidop_usu,' ',apellidom_usu) )as usuario ,id_usu","volar_usuarios","status<>0 order by nombre_usu asc, apellidop_usu asc",""); 

$filcategorias=$cons->consultas('DISTINCT (clasificacion_extra) as clasificacion',"extras_volar","status<>0 ","");


 ?>
<form name="form-filtro" id="form-filtro">
<div class="col-sm-3 col-md-2 col-lg-2 col-xs-6">
	<div class="form-group">
		<label for="fechai">Fecha Inicial</label>
		<input type="date" name="fechai" id="fechai" class="form-control">
	</div>
</div>
<div class="col-sm-3 col-md-2 col-lg-2 col-xs-6">
	<div class="form-group">
		<label for="fechai">Fecha Final</label>
		<input type="date" name="fechaf" id="fechaf" class="form-control">
	</div>
</div>
<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6">
	<div class="form-group">
		<label for="hotel">Categorias</label>
		<select class="selectpicker form-control" id="hotel" name="hotel" data-live-search="true">
			<option value='0'>Todos...</option>
			<?php foreach ($filcategorias as $categoria) { ?>
				<option ><?php echo $categoria->clasificacion; ?></option>
			<?php } ?>
		</select>
	</div>
</div>
</form>
<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
	<button class="btn btn-primary" style="margin-top: 15%" onclick="filtrar_datos(<?php echo "'".$_SESSION['modulo']."'"; ?>);">Buscar</button>
</div>

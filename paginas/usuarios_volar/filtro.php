<?php 
$usuarios=$cons->consultas("DISTINCT( CONCAT(nombre_usu,' ',apellidop_usu,' ',apellidom_usu) )as usuario ,id_usu","volar_usuarios","status<>0 order by nombre_usu asc, apellidop_usu asc",""); 

$deptos=$cons->consultas('id_extra,nombre_extra',"extras_volar","status<>0 and clasificacion_extra='deptousu'","");


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
		<label for="depto">Departamento</label>
		<select class="selectpicker form-control" id="depto" name="depto" data-live-search="true">
			<option value='0'>Todos...</option>
			<?php foreach ($deptos as $depto) { ?>
				<option value="<?php echo $depto->id_extra ?>"><?php echo $depto->nombre_extra; ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<div class="col-sm-3 col-xs-6  col-md-3 col-lg-3">
	<div class="form-group">
		<label for="usuario">Usuarios</label>
		<select id="usuario" name="usuario" class="form-control">
			<option value='0'>Todos...</option>
			<?php foreach ($usuarios as $usuario) { ?>
				<option value="<?php echo $usuario->id_usu ?>"><?php echo  $usuario->usuario ?></option>
			<?php } ?>
		</select>
	</div>
</div>
</form>
<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
	<button class="btn btn-primary" style="margin-top: 15%" onclick="filtrar_datos(filtrar_datos(<?php echo "'".$_SESSION['modulo']."'"; ?>);"><span class="glyphicon glyphicon-filter" ></span></button>
	<button class="btn btn-success" style="margin-top: 15%" onclick="filtrar_datos(<?php echo "'".$_SESSION['modulo']."'"; ?>);">E</button>
</div>

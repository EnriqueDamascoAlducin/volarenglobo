<?php 

$clientes=$cons->consultas("DISTINCT( CONCAT(nombre_temp,' - ',apellidos_temp) )as cliente","temp_volar","status<>0 order by nombre_temp asc, apellidos_temp asc",""); 
 $status=$cons->consultas('DISTINCT(status) as status',"temp_volar","status<>0","");?>
<form name="form-filtro" target="_parent" id="form-filtro" method="POST" action="captura_nuevo/reporteexcel.php">
<div class="col-sm-2 col-md-2 col-lg-2  col-xs-6">
	<div class="form-group">
		<label for="fechai">Fecha Inicial</label>
		<input type="date" name="fechai" id="fechai" class="form-control">
	</div>
</div>
<div class="col-sm-2 col-md-2 col-lg-2  col-xs-6">
	<div class="form-group">
		<label for="fechai">Fecha Final</label>
		<input type="date" name="fechaf" id="fechaf" class="form-control">
	</div>
</div>
<div class="col-sm-2 col-md-2 col-lg-2  col-xs-6">
	<div class="form-group">
		<label for="ciente">Cliente</label>
		<select class="selectpicker form-control" id="cliente" name="cliente" data-live-search="true">
			<option value='0'>Todos...</option>
			<?php foreach ($clientes as $cliente) { ?>
				<option><?php echo $cliente->cliente; ?></option>
			<?php } ?>
		</select>
	</div>
</div>


<div class="col-sm-2 col-md-2 col-lg-2 col-xs-6">
	<div class="form-group">
		<label for="status">Status</label>
		<select id="status" name="status" class="form-control">
			<option value='0'>Todos...</option>
			<?php foreach ($status as $stat) { 
					if( $stat->status ==4){
						$text="Confirmada";
						$class="#0099CC";
					}else if($stat->status==2){
						$text="Sin Cotización";
						$class="#ff4444";
					}else if($stat->status==3){
						$text="Pendiente de Pago";
						$class="#FF8800";
					}else if($stat->status==1){
						$text="Terminado";
						$class="#007E33";
					}else if($stat->status==5){
						$text="Esperando Autorización";
						$class="#007E33";
					}else{
						$text="Error";
						$class="#FF8800";
					}


				?>
				<option value="<?php echo $stat->status ?>" style="color:<?php echo $class; ?>"><?php echo $text; ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<?php 
foreach($permisos as $permiso){
	if($permiso->nombre=="GENERAL"){
	$empleados=$cons->consultas("CONCAT(nombre_usu,' ',apellidop_usu,' ',apellidom_usu) as nombre,id_usu","volar_usuarios","status=1 and id_usu in( SELECT DISTINCT(idusu_temp) as idusu from temp_volar where status<>0)","");
?>

<div class="col-sm-2 col-md-2 col-lg-2 col-xs-6">
	<div class="form-group">
		<label for="empleados">Empleado</label>
		<select class="selectpicker form-control" id="empleados" name="empleados" data-live-search="true">
			<option value='0'>Todos...</option>
			<?php foreach ($empleados as $empleado) { ?>
				<option value="<?php echo $empleado->id_usu; ?>"><?php echo $empleado->nombre; ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<?php
	}
}
?>
<div class="col-sm-2 col-md-2 col-lg-2 col-xs-6">
	<div class="form-group">
		<label for="reserva"># Reserva</label>
		<input type="number" name="reserva" id="reserva" placeholder="# Reserva" class="form-control">
	</div>
</div>
<div class="col-sm-4 col-xs-12 col-md-4 col-lg-4">
	<button class="btn btn-primary" type="button" style="float:left" onclick="filtrar_datos(<?php echo "'".$_SESSION['modulo']."'"; ?>)">Buscar</button>
	<?php foreach ($permisos as $permiso) { ?>
			<?php if($permiso->nombre=="REPORTES"){ ?>
			<button class="btn btn-success" style="float:left" type="submit">Reporte</button>
			<?php } ?>
		<?php } ?>
	
</div>
</form>


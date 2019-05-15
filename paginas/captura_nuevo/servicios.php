<?php
$cantserv=1;
$servi=sizeof($servicios);
$act_servicios=$cons->consultas("idservi_sv,tipo_sv,cantidad_sv,id_sv","servicios_vuelo_temp","status<>0 and idtemp_sv=".$idtemp,"");

$con=$cons->getconect();
$stmt=$con->prepare("select * from servicios_vuelo_temp where idtemp_sv=".$idtemp." and idservi_sv= :servicio");

?>
<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="<?php echo 'div_'.$idtemp;?>" style="background: #3674B2;color:white">
	Servicios 
</div>
<?php foreach ($servicios as $servicio) { ?>
	<?php
		$stmt->bindParam(":servicio",$servicio->id_servicio,PDO::PARAM_STR);
		$stmt->execute();
		$resultado=$stmt->fetchALL (PDO::FETCH_OBJ);
	?>
	<div class="col-sm-3 col-md-3 col-lg-2 col-xs-6" style="border-style: groove; border-width: 5px;height: 100px;max-height: 100px;">
		<?php foreach ($resultado as $res) { ?>
			<?php if($res->tipo_sv==1){ ?>
				<div class="pull-left" style="border-style: groove;border-width: 3px;max-height: 100%;height: 100%;width:60%;max-width: 60% ">
					<label class="copy" for="precio_<?php echo $servicio->id_servicio ?>"  style="width:100%;max-width:100%;margin:0;height: 70%;max-height: 70%;color:black">
						<img src="<?php echo $servicio->img_servicio ?>" title="<?php echo $servicio->nombre_servicio.'('.$servicio->precio_servicio.')' ?>" alt="<?php echo $servicio->nombre_servicio ?>" style="margin:0;height: 70%;max-height: 70%;width: 90%;max-width: 90%;">		
					</label>
					<input type="number" style="width: 100%;" name="precio_<?php echo $servicio->id_servicio ?>" id="precio_<?php echo $servicio->id_servicio ?>" value="<?php if(isset($res->cantidad_sv)){ echo $res->cantidad_sv;}else {echo 0;} ?>"> 
				</div>
			<?php } else{ ?>
				<div class="pull-right" style="border-style: groove;border-width: 3px;max-height: 100%;height: 100%;width:40%;max-width: 40%;vertical-align: middle;">
					<?php if($servicio->cortesia_servicio==1){ ?>
						<label class="copy" for="cortesia_<?php echo $servicio->id_servicio ?>"  style="width:100%;max-width:100%;margin:0;height: 60%;max-height: 100%;color:black">
						<small>Cortesia</small>		
						</label>
						<input type="number" style="width: 100%;" name="cortesia_<?php echo $servicio->id_servicio ?>" id="cortesia_<?php echo $servicio->id_servicio ?>" value="<?php if(isset($res->cantidad_sv)){ echo $res->cantidad_sv;}else {echo 0;} ?>"> 
					<?php } else{?>
						<label class="copy" style="color:black">No Aplica </label>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div>

<?php } ?>
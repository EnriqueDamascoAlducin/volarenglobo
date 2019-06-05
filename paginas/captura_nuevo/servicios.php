<?php

$con=$cons->getconect();
$stmt=$con->prepare("select * from servicios_vuelo_temp where idtemp_sv=".$idtemp." and tipo_sv=1 and idservi_sv= :servicio");
$stmt2=$con->prepare("select * from servicios_vuelo_temp where idtemp_sv=".$idtemp." and tipo_sv=2  and idservi_sv= :servicio");
$checked="";
$checked2="";
?>
<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="<?php echo 'div_'.$idtemp;?>" style="background: #3674B2;color:white">
	Servicios 
</div>
<?php foreach ($servicios as $servicio) { ?>
	<?php
		$stmt->bindParam(":servicio",$servicio->id_servicio,PDO::PARAM_STR);
		$stmt->execute();
		$serviciosPago=$stmt->fetchALL (PDO::FETCH_OBJ);

		$stmt2->bindParam(":servicio",$servicio->id_servicio,PDO::PARAM_STR);
		$stmt2->execute();
		$serviciosCortesia=$stmt2->fetchALL (PDO::FETCH_OBJ);
	?>
	<div class="col-sm-3 col-md-3 col-lg-2 col-xs-6" style="border-style: groove; border-width: 5px;height: 100px;max-height: 100px;">
				<div class="pull-left" style="border-style: groove;border-width: 3px;max-height: 100%;height: 100%;width:60%;max-width: 60% ">
					<label class="copy" for="precio_<?php echo $servicio->id_servicio ?>"  style="width:100%;max-width:100%;margin:0;height: 70%;max-height: 70%;color:black">
						<img src="<?php echo $servicio->img_servicio ?>" title="<?php echo $servicio->nombre_servicio.'('.$servicio->precio_servicio.')' ?>" alt="<?php echo $servicio->nombre_servicio ?>" style="margin:0;height: 70%;max-height: 70%;width: 90%;max-width: 90%;">		
					</label>
					
					<?php if(isset($serviciosPago->cantidad_sv) && $serviciosPago[0]->cantidad_sv>0){ 
						$checked="checked";
					}else {
						$checked="";
					}
					?>
					<input type="checkbox" name="precio_<?php echo $servicio->id_servicio ?>" id="precio_<?php echo $servicio->id_servicio ?>" value="1" <?php echo $checked; ?> onclick="validate_service(this,<?php echo $servicio->cantmax_servicio ?>)" >
				</div>
				<div class="pull-right" style="border-style: groove;border-width: 3px;max-height: 100%;height: 100%;width:40%;max-width: 40%;vertical-align: middle;">
					<?php if($servicio->cortesia_servicio==1){ ?>
						<label class="copy" for="cortesia_<?php echo $servicio->id_servicio ?>"  style="width:100%;max-width:100%;margin:0;height: 60%;max-height: 100%;color:black">
						<small>Cortesia</small>		
						</label>
						
						<?php if(isset($serviciosCortesia[0]->cantidad_sv) && $serviciosCortesia[0]->cantidad_sv>0){ 
							$checked2="checked";
						}else {
							$checked2="";
						} ?>		
						<input type="checkbox" name="cortesia_<?php echo $servicio->id_servicio ?>" id="cortesia_<?php echo $servicio->id_servicio ?>" <?php echo $checked2 ?> onclick="validate_service(this,<?php echo $servicio->cantmax_servicio ?>)" value="">				
					<?php } else{?>
						<label class="copy" style="color:black">No Aplica </label>
					<?php } ?>
				</div>
	</div>

<?php } ?>
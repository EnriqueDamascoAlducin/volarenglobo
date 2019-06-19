<?php
$ch="";
$ch2="";
$val="";
$val1="";
 if(isset($datos) && isset($datos[0]->tdescuento_temp) && $datos[0]->tdescuento_temp!=NULL ){
 	if(  $datos[0]->tdescuento_temp==1){
 		$ch="checked";
 		$val=$datos[0]->cantdescuento_temp;
 	}elseif ($datos[0]->tdescuento_temp==2) {
 		$ch2="checked";
 		$val1=$datos[0]->cantdescuento_temp;
 	}
 }
?>
<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12" style="background-color: #3674B2;color: white">
	Tipo de Descuento
</div>
	<div class="col-sm-3 col-lg-3 col-lg-3 col-xs-6">
		<div class="form-group">
		    <label for="tdescuento">Por Porcentaje:</label>
		    <input type="radio" name="tdescuento" id="tdescuento" value="1" class="form-control" <?php echo $ch; ?> >
   		</div>
  	</div>
  	<div class="col-sm-3 col-lg-3 col-lg-3 col-xs-6">
  		<div class="form-group">
  			<label for="cantdescuento"></label>
  			<select id="cantdescuento" name="cantdescuento" disabled="disabled" class="form-control">
					<?php 
					for($i=0;$i<=50;$i=$i+5){
						$attr="";
						if($i==$val){
							$attr="selected";
						}
						echo "<option $attr >".$i."</option>";
					}
					?>
				</select>
  		</div>
  	</div>
  	<div class="col-sm-3 col-lg-3 col-lg-3 col-xs-6">
		<div class="form-group">
		    <label for="tdescuento1">Por Pesos:</label>
		    <input type="radio" name="tdescuento" id="tdescuento1" value="2" class="form-control" <?php echo $ch2; ?>>
   		</div>
  	</div>
  	<div class="col-sm-3 col-lg-3 col-lg-3 col-xs-6">
		<div class="form-group">
		    <label for="cantdescuento1">Pesos:</label>
		    <input type="number" name=cantdescuento id="cantdescuento1" disabled="disabled" value="<?php echo $val1; ?>" class="form-control" >
		</div>
  	</div>

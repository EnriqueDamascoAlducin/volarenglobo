<?php
$ch="";
$ch2="";
$val="";
$val1="";
 if(isset($datos) ){
 	if($datos[0]->tdescuento_temp!=null && $datos[0]->tdescuento_temp==1){
 		$ch="checked";
 		$val=$datos[0]->cantdescuento_temp;
 	}elseif ($datos[0]->tdescuento_temp!=null && $datos[0]->tdescuento_temp==2) {
 		$ch2="checked";
 		$val1=$datos[0]->cantdescuento_temp;
 	}
 }
?>
<div class="col-sm-12 col-lg-12 col-md-12" style="background-color: #3674B2;color: white">
	Tipo de Descuento
</div>
<table class="tabla">
	<tbody>
		<tr>
			<td >
				<small class="p">Por Porcentaje: </small>
				<input type="radio" name="tdescuento" id="tdescuento" value="1" <?php echo $ch; ?>>
			</td>
			<td>
				<select id="cantdescuento" name="cantdescuento" disabled="disabled" style="max-width: 25%">
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
				<small class="p">% </small>
			</td>
		</tr>
		<tr>
			<td >
				<small class="p">Por Pesos: </small>
				<input type="radio" name="tdescuento" id="tdescuento1" value="2" <?php echo $ch2; ?>>
			</td>
			<td>
				<input type="number" name=cantdescuento id="cantdescuento1" style="max-width: 25%" disabled="disabled" value="<?php echo $val1; ?>" >
				<small class="p"> Pesos </small>
			</td>
		</tr>
		
	</tbody>
</table>
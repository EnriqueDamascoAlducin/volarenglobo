<?php

$tarifas=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='tarifas'","");
$estados=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='estados'","");
$motivos=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='motivos'","");
$tipos=$cons->consultas("nombre_extra,abrev_extra,id_extra","extras_volar","status=1 and clasificacion_extra='tiposv'","");
$con=$cons->getconect();
$stmt=$con->prepare("select * from vueloscat_volar where tipo_vc= :tipo");



?>
<div class="col-sm-12 col-xs-12 col-lg-12 col-md-12" style="background: #3674B2;color:white">
	Datos Generales
</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
	    <label for="codigo">Codigo:</label>
	    <input  class="form-control" type="number" name="codigo"  id="codigo" readonly="readonly" value="<?php echo $idtemp; ?>">
	</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
		<label for="nombre">Nombre:</label>
		<input class="form-control" type="text" name="nombre" id="nombre"  value="<?php if(isset($datos)){echo $datos[0]->nombre_temp ;} ?>">
   	</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
		<label for="apellidos">Apellidos:</label>
		<input class="form-control" type="text" name="apellidos" id="apellidos" value="<?php if(isset($datos)){echo $datos[0]->apellidos_temp;} ?>">
   	</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
		<label for="mail">E-mail:</label>
		<input class="form-control" type="email" name="mail" id="mail" value="<?php if(isset($datos)){echo $datos[0]->mail_temp;} ?>">
   	</div>
</div>  	
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
		<label for="telfijo">Teléfono Fijo:</label>
		<input class="form-control" type="text" id="telfijo" name="telfijo" value="<?php if(isset($datos)){echo $datos[0]->telfijo_temp;} ?>">
   	</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
	    <label for="telcelular">Teléfono Celular:</label>
	    <input class="form-control" type="text" id="telcelular" name="telcelular" value="<?php if(isset($datos)){echo $datos[0]->telcelular_temp;} ?>">
   	</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
	    <label for="procedencia">Procedencia:</label>
	    <select name="procedencia" id="procedencia" class="form-control"> 
			<option value='0'>Selecciona un Estado</option>
			<?php 
			foreach ($estados as $estado) {
				$attr="";
				if(isset($datos) && $datos[0]->procedencia_temp==$estado->id_extra){
					$attr="selected";
				}
				echo "<option $attr value='".$estado->id_extra."'>".$estado->nombre_extra."(".$estado->abrev_extra.")";
			}
			?>
		</select>
	</div>
</div>
  	<div class="col-sm-6 col-xs-6 col-md-1 col-lg-1">
		<div class="form-group">
		    <label for="pasajerosa">Adultos </label>
		  	<input type="number" id="pasajerosa" name="pasajerosa" value="<?php if(isset($datos)){echo $datos[0]->pasajerosa_temp;}else echo 1; ?>" class= "form-control">  
   		</div>
  	</div>
  	<div class="col-sm-6 col-xs-6 col-md-1 col-lg-1">
		<div class="form-group">
		    <label for="pasajerosn">Niños </label>
				<input type="number" id="pasajerosn" name="pasajerosn" value="<?php if(isset($datos)){echo $datos[0]->pasajerosn_temp;}else{echo 0;} ?>"class= "form-control">  
   		</div>
  	</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3" >
	<div class="form-group">
	    <label for="motivo">Motivo:</label>
	    <select name="motivo" id="motivo" class="form-control">
	    	<option value='0'>Selecciona un Motivo</option>
			<?php 
			foreach ($motivos as $motivo) {
				$attr="";
				if(isset($datos) && $datos[0]->motivo_temp==$motivo->id_extra){
					$attr="selected";
				}
				echo "<option $attr value='".$motivo->id_extra."'>".$motivo->nombre_extra;
			}
			?>
		</select>
	</div>
</div>
<div class="col-sm-6 col-xs-6 col-lg-3 col-lg-3">
	<div class="form-group">
	    <label for="tipo">Tipo de Vuelo:</label>
	    <select name="tipo" id="tipo" class="form-control">
			<option value='0'>Selecciona un tipo</option>
			<?php 
			foreach ($tipos as $tipo) {
			?>
				<optgroup label="<?php echo $tipo->nombre_extra; ?>">
					<?php
					$stmt->bindParam(":tipo",$tipo->id_extra,PDO::PARAM_STR);
					$stmt->execute();
					$resultado=$stmt->fetchALL (PDO::FETCH_OBJ);
					foreach ($resultado as $data) { 
						$attr="";
						if(isset($datos) ){
							if($datos[0]->tipo_temp==$data->id_vc){
								$attr="selected";
							}
						}
						echo "<option $attr value='".$data->id_vc."'>".utf8_encode( $data->nombre_vc ). "</option>";
					} ?>
				</optgroup>
			<?php  } ?>
		</select>
	</div>
</div>
<div class="col-sm-6 col-lg-3 col-lg-3">
	<div class="form-group">
	    <label for="fechavuelo">Fecha de Vuelo:</label>
	    <input type="date" id="fechavuelo" name="fechavuelo" value="<?php if(isset($datos)){echo $datos[0]->fechavuelo_temp;} ?>" class= form-control>
	</div>
</div>
<div class="col-sm-6 col-lg-3 col-lg-3">
	<div class="form-group">
	    <label for="tarifa">Tipo de Tarifa:</label>
	    <select id="tarifa" name="tarifa" class="form-control">
			<option value='0'>Selecciona una Tarifa</option>
			<?php 
			foreach ($tarifas as $tarifa) {
				$attr="";
				if(isset($datos) && $datos[0]->tarifa_temp==$tarifa->id_extra){
					$attr="selected";
				 }
				echo "<option $attr value='".$tarifa->id_extra."'>".$tarifa->nombre_extra;
			}
			?>
		</select>
	</div>
</div>
<!--
<table class="tabla">


	<tbody>
		<tr>
			<td >
				<small class="p">Codigo: </small> 
				<input type="number" name="codigo"  id="codigo" readonly="readonly" value="<?php echo $idtemp; ?>">
			</td>
			<td>
				<small class="p">Nombre: </small> 
				<input type="text" name="nombre" id="nombre"  value="<?php if(isset($datos)){echo $datos[0]->nombre_temp ;} ?>">
			</td>
		</tr>
		<tr>
			<td >
				<small class="p">Apellidos: </small> 
				<input type="text" name="apellidos" id="apellidos" value="<?php if(isset($datos)){echo $datos[0]->apellidos_temp;} ?>">
			</td>
			<td>
				<small class="p">E-mail: </small> 
				<input name="mail"  type="email" id="mail" value="<?php if(isset($datos)){echo $datos[0]->mail_temp;} ?>">
			</td>
		</tr>
		<tr>
			<td >
				<small class="p" >Telefono Fijo: </small> 
				<input name="telfijo" type="text" id="telfijo" value="<?php if(isset($datos)){echo $datos[0]->telfijo_temp;} ?>">
			</td>
			<td>
				<small class="p">Telefono Celular: </small	> 
				<input name="telcelular" type="text" id="telcelular" value="<?php if(isset($datos)){echo $datos[0]->telcelular_temp;} ?>">
			</td>
		</tr>
		<tr>
			<td >
				<small class="p" >Procedencia: </small> 
				<select name="procedencia" id="procedencia">
						<option value='0'>Selecciona un Estado</option>
						<?php 
						foreach ($estados as $estado) {
							$attr="";
							 if(isset($datos) && $datos[0]->procedencia_temp==$estado->id_extra){
							 	$attr="selected";
							 }
							echo "<option $attr value='".$estado->id_extra."'>".$estado->nombre_extra."(".$estado->abrev_extra.")";
						}
						?>
				</select>
			</td>
			<td>
				<small class="p">Pasajeros </small	><br> 
				<small class="p">Adultos/Niños </small	> <br>
				<input type="number" id="pasajerosa" name="pasajerosa" value="<?php if(isset($datos)){echo $datos[0]->pasajerosa_temp;}else echo 1; ?>" style="max-width: 25%;text-align: center;">
				<input type="number" id="pasajerosn" name="pasajerosn" value="<?php if(isset($datos)){echo $datos[0]->pasajerosn_temp;}else{echo 0;} ?>"style="max-width: 25%;text-align: center;">
			</td>
		</tr>
		<tr>
			<td >
				<small class="p" >Motivo del Vuelo: </small> 
				<select name="motivo" id="motivo">

						<option value='0'>Selecciona un Motivo</option>
						<?php 
							foreach ($motivos as $motivo) {

							$attr="";
							 if(isset($datos) && $datos[0]->motivo_temp==$motivo->id_extra){
							 	$attr="selected";
							 }
								echo "<option $attr value='".$motivo->id_extra."'>".$motivo->nombre_extra;
							}
						?>
				</select>					</td>
			<td>
				<small class="p">Tipo de Vuelo: </small	> 
				<select name="tipo" id="tipo">

					<option value='0'>Selecciona un tipo</option>
					<?php 
						foreach ($tipos as $tipo) {
					?>
					<optgroup label="<?php echo $tipo->nombre_extra; ?>">
						<?php
						$stmt->bindParam(":tipo",$tipo->id_extra,PDO::PARAM_STR);
						$stmt->execute();
						$resultado=$stmt->fetchALL (PDO::FETCH_OBJ);
						foreach ($resultado as $data) { 
							$attr="";
							if(isset($datos) ){
							 	if($datos[0]->tipo_temp==$data->id_vc){
							 		$attr="selected";
							 	}
							 	
							 }
							echo "<option $attr value='".$data->id_vc."'>".utf8_encode( $data->nombre_vc ). "</option>";
						} ?>
					</optgroup>
					<?php  } ?>

				</select>
			</td>
		</tr>
		<tr>
			<td >
				<small class="p" >Fecha de Vuelo: </small> 
				<input type="date" id="fechavuelo" name="fechavuelo" value="<?php if(isset($datos)){echo $datos[0]->fechavuelo_temp;} ?>">
			</td>
			<td>
				<small class="p">Tipo de Tarifa: </small	> 
				<select id="tarifa" name="tarifa">
						<option value='0'>Selecciona una Tarifa</option>
						<?php 
						foreach ($tarifas as $tarifa) {
							$attr="";
							 if(isset($datos) && $datos[0]->tarifa_temp==$tarifa->id_extra){
							 	$attr="selected";
							 }
							echo "<option $attr value='".$tarifa->id_extra."'>".$tarifa->nombre_extra;
						}
						?>
				</select>
			</td>
		</tr>
	</tbody>
</table>-->
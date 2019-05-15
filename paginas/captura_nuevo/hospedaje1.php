<div class="col-sm-12 col-xs-12 col-lg-12 col-md-12" style="background: #3674B2;color:white">
	Hospedaje
</div>

	<div class="col-sm-12 col-lg-6 col-lg-6 col-xs-6">
		<div class="form-group">
		    <label for="hotel">Hotel:</label>
		    <select name="hotel" id="hotel" class="form-control">
				<?php 
				$est="";$fam="";$Lujo="";
				if(isset($datos)){

					if( $datos[0]->hotel_temp=="1"){
				  		$est="selected";
				 	}else if( $datos[0]->hotel_temp=="2"){
				  		$fam="selected";
				 	}else if( $datos[0]->hotel_temp=="3"){
				  		$Lujo="selected";
				 	}
				}
				?>
				<option value='0'>Selecciona un hotel</option>
				<option <?php echo $est?> value='1'>Quinto Sol</option>
				<option <?php echo $fam?> value='2'>Villas Arqueologicas</option>
				<option <?php echo $Lujo?> value='4'>Posada Jade</option>
			</select>
   		</div>
	</div>
	<div class="col-sm-12 col-lg-6 col-lg-6 col-xs-6">
		<div class="form-group">
		    <label for="habitacion">Habitación:</label>
		    <select  name="habitacion" id="habitacion" class="form-control">
				<?php 
				$est="";$fam="";$Lujo="";
				if(isset($datos)){

					if( $datos[0]->habitacion_temp=="1"){
				  		$est="selected";
				 	}else if( $datos[0]->habitacion_temp=="2"){
				  		$fam="selected";
				 	}else if( $datos[0]->habitacion_temp=="3"){
				  		$Lujo="selected";
				 	}
				}
				?>
				<option value='0'>Selecciona una habitación</option>
				<option <?php echo $est;?> value='1'>Estandar</option>
				<option <?php echo $fam;?> value='2'>Familiar</option>
				<option <?php echo $Lujo;?> value='3'>De Lujo</option>
			</select>
   		</div>
  	</div>
  	<div class="col-sm-12 col-lg-6 col-lg-6 col-xs-6">
		<div class="form-group">
		    <label for="checkin">CheckIn:</label>
		    <input name="checkin" type="date" id="checkin" value="<?php if(isset($datos) && $datos[0]->checkin_temp!='0000-00-00'){echo $datos[0]->checkin_temp;} ?>" class= "form-control">
   		</div>
  	</div>
  	<div class="col-sm-12 col-lg-6 col-lg-6 col-xs-6">
		<div class="form-group">
		    <label for="checkout">CheckOut:</label>
		    <input name="checkout" type="date" id="checkout" value="<?php if(isset($datos) && $datos[0]->checkin_temp!='0000-00-00'){echo $datos[0]->checkout_temp;} ?>" class= "form-control">
   		</div>
  	</div>
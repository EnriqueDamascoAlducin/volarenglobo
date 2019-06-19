<?php 
	
	include "../../crud/fin_session.php";
	$_SESSION['tabla']="servicios_volar";
	include_once "../../css/log/c/conexion.php";
	$datos="";
	if(isset($_POST['id'])){
		$datos=$cons->consultas("*",$_SESSION['tabla'],"id_servicio=".$_POST['id'],"");
	}


	
	////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email;10=input telefono
	
	$query=["(nombre_extra) as text, id_extra as value","extras_volar","status=1 and clasificacion_extra='deptousu'"];
	$valores=[''];
	
	$cont=0;
	include "../../dinamicos/inputs.php";
	$array=["nombre_servicio","precio_servicio","img_servicio"];
	$size=[1,3,3,3,3,3,3,3,3,3,3,3,1,4];
	$type=[1,1,1,1,1,1,1,4,2,10,10,9,6,1];
	$estados=["id_extra as value, nombre_extra as text","extras_volar","clasificacion_extra='estados' and status=1"];
	$options=["","","","","","","",$estados,"","","","","",""];
	$req=["required","required","required","","","required","","","","","","","",""];
?>
<form name="formulario" id="formulario" onsubmit="enviar_crud(event,'<?php echo $_SESSION['modulo'] ?>',<?php echo $_SESSION['idpagina'] ?>);">
	<?php 
	if(isset($_POST['id'])){
		echo "<input type='hidden' name='id' id='id' value='".$_POST['id']."'>";
	}
	?>
	<?php foreach ($campos as $campo) {
		if(in_array($campo->Field, $array)){
		campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$req[$cont],$cons);
		}
		$cont++;
	} ?>
	<?php $tamano=3; $campo="cortesia"; $comentario="¿Aplica Cortesia?"; $attr="required"; $color="style='color:red;'";?>
		<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo; ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<select class="form-control" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>">
					<option value=""><?php echo "Selecciona una Opción "; ?></option>
					<?php
					$opc1="";$opc2="";
						if($datos!="" ){
							if($datos[0]->cortesia_servicio == 1){
								$opc1="selected";
							}else if($datos[0]->cortesia_servicio==0){
								$opc2="selected";
							}
						}
					?>
					<option value="1" <?php echo $opc1; ?> >Si</option>
					<option value="0" <?php echo $opc2; ?> >No</option>
				</select>
			</div>
		</div>
	<?php $tamano=3; $campo="cantmax"; $comentario="Valor por Default"; $attr="required"; ?>
	
		<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo; ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<select class="form-control" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>">
					<option value=""><?php echo "Selecciona una Opción "; ?></option>
					<?php
					$opc1="";$opc2="";
						if($datos!="" ){
							if($datos[0]->cantmax_servicio == 1){
								$opc1="selected";
							}else if($datos[0]->cantmax_servicio==0){
								$opc2="selected";
							}
						}
					?>
					<option value="1" <?php echo $opc1; ?> >1</option>
					<option value="0" <?php echo $opc2; ?> >Automatico</option>
				</select>
			</div>
		</div>

		<div id="div_botones" class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
		<?php if(!isset($_POST['id'])){ ?>
			<button type="submit" class="btn btn-success">Guardar</button>
		<?php }else{ ?>
			<button type="submit" class="btn btn-primary">Actualizar</button>
		<?php } ?>
		</div>
</form>
<?php 
	
	include "../../crud/fin_session.php";
	$_SESSION['tabla']="extras_volar";
	include_once "../../css/log/c/conexion.php";
	$datos="";
	if(isset($_POST['id'])){
		$datos=$cons->consultas("*",$_SESSION['tabla'],"id_extra=".$_POST['id'],"");
	}


	
	////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email;10=input telefono
	
	$query=["distinct (clasificacion_extra) as text,  (clasificacion_extra) as value","extras_volar","status=1 "];
	$valores=[''];
	include "../../dinamicos/inputs.php";
	$array=["abrev_extra","nombre_extra","clasificacion_extra"];
	$size=[1,4,4,3,3];
	$type=[1,1,1,4,1];
	$options=["","","",$query,"","","","","","","","","",""];
	$req=["required","","required","required","","required","","","","","","","",""];
?>
<form name="formulario" id="formulario" onsubmit="enviar_crud(event,'<?php echo $_SESSION['modulo'] ?>',<?php echo $_SESSION['idpagina'] ?>);">
	<?php 
	if(isset($_POST['id'])){
		echo "<input type='hidden' name='id' id='id' value='".$_POST['id']."'>";
	}
	?>
	<?php 
		$cont=0;foreach ($campos as $campo) {
		if(in_array($campo->Field, $array)){
		campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$req[$cont],$cons);
		}
		$cont++;
	} ?>

	
		<div id="div_botones" class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
		<?php if(!isset($_POST['id'])){ ?>
			<button type="submit" class="btn btn-success">Guardar</button>
		<?php }else{ ?>
			<button type="submit" class="btn btn-primary">Actualizar</button>
		<?php } ?>
		</div>
</form>
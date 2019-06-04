<?php 
	
	include "../../crud/fin_session.php";
	$datos="";
	include_once "../../css/log/c/conexion.php";
	$_SESSION['tabla']="globos_volar";
	if(isset($_POST['id'])){
		$datos=$cons->consultas("*",$_SESSION['tabla'],"id_globo=".$_POST['id'],"");
	}
	////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email;10=input telefono
	
	$cont=0;
	include "../../dinamicos/inputs.php";
	$size=[1,3,3,3,3,3,3,3,3,3,3,3,1,4];
	$type=[1,1,1,2,2,1,1,4,2,10,10,9,6,1];
	$array=["nombre_globo","peso_globo","maxpersonas_globo","placa_globo"];
	$options=["","","","","","","","","","","","","",""];
	$req=["required","required","required","required","","required","","","","","","","",""];
?>
<form name="formulario" id="formulario" onsubmit="enviar_crud(event);">
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

	
	<?php if(!isset($_POST['bloqueado'])){ ?>
		<div id="div_botones" class="col-sm-6 col-xs-6 col-lg-6 col-md-6">
		<?php if(!isset($_POST['id'])){ ?>
			<button type="submit" class="btn btn-success">Guardar</button>
		<?php }else{ ?>
			<button type="submit" class="btn btn-primary">Actualizar</button>
		<?php } ?>
		</div>
	<?php } ?>
</form>
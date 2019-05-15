<?php 
	session_start();
	$_SESSION['tabla']="gastos_volar";
	include_once "../../css/log/c/conexion.php";
	$datos="";
	if(isset($_POST['id'])){
		$datos=$cons->consultas("*",$_SESSION['tabla'],"id_hotel=".$_POST['id'],"");
	}	
	////tipos   ----> 1= input text; 2= input number; 3=select estatico; 4 = select dinamico; 5=textarea; 6=input file; 7= input date; 8=date-timelocal; 9=input email;10=input telefono
	$query=["(nombre_extra) as text, id_extra as value","extras_volar","status=1 and clasificacion_extra='deptousu'"];
	$valores=[''];
	
	$cont=0;
	include "../../dinamicos/inputs.php";
	$array=["fecha_gasto","tipo_gasto","cantidad_gasto","referencia_gasto","comentario_gasto"];
	$size=[1,3,3,3,3,3,3,3,3,3,3,3,1,4];
	$type=[1,7,4,2,1,1,5,4,2,10,10,9,6,1];
	$gastos=["id_extra as value, nombre_extra as text","extras_volar","clasificacion_extra='tipogastos' and status=1"];
	$options=["","",$gastos,"","","","","","","","","","",""];
	$req=["required","required","required","","","required","","","","","","","",""];
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
	<?php $tamano=3;
	 $campo="metodo";
	 $color="black";
	 $comentario="Pagado con: "; ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo; ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<select class="form-control" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>">
					<option value=""><?php echo "Selecciona un ". utf8_encode($comentario); ?></option>
					<option value="1">Efectivo</option>
					<option value="2">Tarjeta</option>
					<option value="3">Ambos</option>
				</select>
			</div>
		</div>
	<?php if(!isset($_POST['bloqueado'])){ ?>
		<div id="div_botones" class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
		<?php if(!isset($_POST['id'])){ ?>
			<button type="submit" class="btn btn-success">Guardar</button>
		<?php }else{ ?>
			<button type="submit" class="btn btn-primary">Actualizar</button>
		<?php } ?>
		</div>
	<?php } ?>
</form>
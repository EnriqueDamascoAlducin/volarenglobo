<?php 
	
	include "../../crud/fin_session.php";
	if(isset($_POST['idpagina'])){
		$_SESSION['idpagina']=$_POST['idpagina'];
	}
	$_SESSION['modulo']="agregar_servicio/";
	$_SESSION['tabla']="servicios_volar";
	$_SESSION['extraquery']="";
	include_once "../../css/log/c/conexion.php";
	$permisos=$cons->consultas("nombre_sp as nombre","permisosusuarios_volar pv,subpermisos_volar sv","id_sp=idsp_puv and idusu_puv=".$_SESSION['id']." and pv.status=1 and sv.status=1 and permiso_sp=".$_SESSION['idpagina'],"");
	$con=$cons->getconect();
	$stmt=$con->prepare("select nombre_extra from extras_volar where id_extra= :id");
	$stmt2=$con->prepare("select nombre_puesto from puestos_volar where id_puesto= :id");

	//////Es para mi consulta de hoteles
	$filtro="status<>0 ";
	if(isset($_POST['fechaf'])){ 
		if(isset($_POST['fechai']) && $_POST['fechai']!=""){
			$filtro.=" and register>='".$_POST['fechai']." 00:00:00'";
		}
		if(isset($_POST['fechaf']) && $_POST['fechaf']!=""){
			$filtro.=" and register<'".$_POST['fechaf']." 23:59:59'";
		}
		if(isset($_POST['servicio'])  && $_POST['servicio']!="0"){
			$filtro.=" and id_servicio=".$_POST['hotel'];
		}
	}

	$campos="nombre_servicio,precio_servicio,id_servicio AS id";
	$data=$cons->consultas($campos,$_SESSION['tabla'],$filtro,"");
	/////Consulta de hoteles
	

?>
<nav class="navbar navbar-light bg-info">
	<div class="pull-left" style="margin-left: 5%;margin-top: 1%"> 
		<?php foreach ($permisos as $permiso) { 
			if(("AGREGAR"== $permiso->nombre)){ ?>
		<label onclick="abrir_forms(0,'<?php echo $_SESSION['modulo'] ?>form.php')"><span class="glyphicon glyphicon-plus" style="color: #3F729B"></span>&nbsp;Agregar</label>
		<?php } }?>
	</div>
</nav>
<?php 
	include"filtro.php";
?>
<div id="tabla-reservas">
<table class="table DataTable display">
	<thead>
		<tr>
			<th style="text-align: center;vertical-align: middle;max-width: 30%;width: 30%">Nombre</th>
			<th style="text-align: center;vertical-align: middle;max-width: 10%;width: 10%">Precio</th>
			<th style="text-align: center;vertical-align: middle;max-width: 10%">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $dato) { ?>
			<tr>
				<td>
					<?php echo $dato->nombre_servicio; ?>
				</td>
				<td>
					<?php echo $dato->precio_servicio; ?>
				</td>
				<td style="text-align: center;vertical-align: middle;max-width: 10%">
					<?php if(sizeof($permisos)>0){ ?>
						<?php foreach ($permisos as $permiso) { ?>
							<?php if($permiso->nombre=="EDITAR"){ ?>
								<span class="glyphicon glyphicon-edit" style="color: #33b5e5" onclick="abrir_forms(<?php echo $dato->id ?>,'<?php echo $_SESSION['modulo'] ?>form.php')"></span>
							<?php } ?>
							<?php if($permiso->nombre=="ELIMINAR"){ ?>
								<span id='trash_<?php echo $dato->id ?>' class='glyphicon glyphicon-trash' style='color:red' onclick='confirmar_icon(this.id,1)' >
                  				</span>
                  				<div  style='display:none'>
                      				<span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick="actualizar_status(0,<?php echo $dato->id ?>,'<?php echo $_SESSION["modulo"]?>',<?php echo $_SESSION['idpagina'] ?>)"></span>
                    				<span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id='opc_<?php echo $dato->id ?>' onclick='confirmar_icon(this.id,0)'></span>
                  				</div>
							<?php } ?>
						<?php } ?>
					<?php } else{?>
							Sin permisos
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<script type="text/javascript">
	tables();

</script>

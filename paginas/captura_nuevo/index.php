<?php

include_once '../../crud/fin_session.php';

if(isset($_POST['idpagina'])){
	$_SESSION['idpagina']=$_POST['idpagina'];
}
$_SESSION['modulo']="captura_nuevo/";
include_once "../../css/log/c/conexion.php";
$id=$_SESSION['id'];
$_SESSION['tabla']="temp_volar";
$usuario=$cons->consultas("CONCAT(nombre_usu,' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'')) as nombre","volar_usuarios","id_usu=".$id,"");
$campo="";
$permisos=$cons->consultas("nombre_sp as nombre,id_sp as id","permisosusuarios_volar pv,subpermisos_volar sv","id_sp=idsp_puv and idusu_puv=".$_SESSION['id']." and pv.status=1 and sv.status=1 and permiso_sp=".$_SESSION['idpagina'],"");
function extras($campos,$id,$cons){
	$convert=$cons->consultas($campos,"extras_volar","id_extra=".$id,"");
	if (isset($convert[0])) {
		return $convert[0]->resultado;
	}else{
		return "NA";
	}	
}
$filtro="status<>0  and idusu_temp=".$id;
foreach($permisos as $permiso){
	if($permiso->nombre=="GENERAL"){
		$filtro="status<>0 ";
	}
}
if(isset($_POST['fechaf'])){
	if($_POST['fechai']!=""){
		$filtro.=" and fechavuelo_temp>='".$_POST['fechai']."'";
	}
	if($_POST['fechaf']!=""){
		$filtro.=" and fechavuelo_temp<='".$_POST['fechaf']."'";
	}
	if($_POST['cliente']!="" && $_POST['cliente']!="0" ){
		$separacion = explode(" - ", $_POST['cliente']);
		$filtro.=" and nombre_temp like'%".$separacion[0]."%'";
		$filtro.=" and apellidos_temp like'%".$separacion[1]."%'";
	}
	if($_POST['status']!="" && $_POST['status']!="0"){
		$filtro.=" and status='".$_POST['status']."'";
	}
	if(isset($_POST['empleados']) && $_POST['empleados']!="" && $_POST['empleados']!="0"){
		$filtro.=" and idusu_temp='".$_POST['empleados']."'";
	}
	if($_POST['reserva']!=""){
		$filtro.=" and id_temp=".$_POST['reserva'];
	}
}

$reservas=$cons->consultas("id_temp,CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as nombre, mail_temp,CONCAT(ifnull(telfijo_temp,''),' / ',ifnull(telcelular_temp,'')) as telefonos, status,idusu_temp,fechavuelo_temp","temp_volar ",$filtro,"");
?>

<center>
<nav class="navbar navbar-light bg-info">
	<div class="pull-left" style="margin-left: 5%;margin-top: 1%"> 
		<?php foreach ($permisos as $permiso) { ?>
			<?php if($permiso->nombre=="AGREGAR"){ ?>
			<label onclick="cargar_nuevo('nuevo.php')"><span class="glyphicon glyphicon-plus" style="color: #3F729B"></span>&nbsp;Agregar</label>
			<?php } ?>
		<?php } ?>
	</div>
</nav>
<?php
	include"filtro.php";
?>
</center>
<div id="tabla-reservas">
	<table class="table DataTable display" >
	<thead>
		<tr>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;"># Reserva</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Nombre</th>
			<?php
				foreach($permisos as $permiso){
					if($permiso->nombre=="GENERAL"){
			?>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Empleado</th>
			<?php 
					}
				}
			?>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Correo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Telefonos Fijo/Celular</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Fecha de Vuelo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Status</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1% !important;">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($reservas as $reserva) { ?>
			<tr>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->id_temp ?></td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->nombre ?></td>

				<?php
					foreach($permisos as $permiso){
						if($permiso->nombre=="GENERAL"){
							$empleado=$cons->consultas("CONCAT(nombre_usu,' ',apellidop_usu,' ',apellidom_usu) as nombre","volar_usuarios","status=1 AND id_usu=".$reserva->idusu_temp,"");
				?>
				<td style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;"><?php echo $empleado[0]->nombre; ?></td>
				<?php 
						}
					}
				?>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->mail_temp ?></td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->telefonos ?></td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php 
					if($reserva->fechavuelo_temp=="" || $reserva->fechavuelo_temp=="0000-00-00" || $reserva->fechavuelo_temp==NULL){
						echo " Fecha No Asiganada";
					}
					else{
						echo $reserva->fechavuelo_temp;
					}
				?> 
					
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;">
					<?php if( $reserva->status ==4){
						$text="Confirmada";
						$class="info";
					}else if($reserva->status==2){
						$text="Sin Cotización";
						$class="danger";
					}else if($reserva->status==3){
						$text="Pendiente de Pago";
						$class="warning";
					}else if($reserva->status==1){
						$text="Terminado";
						$class="success";
					}else if($reserva->status==5){
						$text="Esperando Autorización";
						$class="success";
					}else{
						$text="Error";
						$class="danger";
					}
					?>
					<div class="progress">
					 	<div class="progress-bar progress-bar-<?php echo $class; ?>" role="progressbar" aria-valuenow="40"
					  aria-valuemin="0" aria-valuemax="100" style="width:100%">
					    <?php echo $text; ?>
					  </div>
					</div>
				</td>

				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;">
					<div class="pull-rigth" style="width: 100%">
					<?php if($reserva->status!=1){ ?>
						<?php foreach ($permisos as $permiso){ ?>
							<?php if(($permiso->nombre=="EDITAR" && $reserva->idusu_temp==$_SESSION['id']) || $permiso->nombre=="EDITAR GRAL" ){ ?>
								<span class="glyphicon glyphicon-edit" onclick='editar_reserva(<?php echo $reserva->id_temp ?>,1)' title='Editar'  style='color:#33b5e5;font-size:100%' style="margin-right: 2px"></span>
							<?php } ?>
							<?php if(($permiso->nombre=="ELIMINAR" && $reserva->idusu_temp==$_SESSION['id']) || $permiso->nombre=="ELIMINAR GRL" ){ ?>
								<span class="glyphicon glyphicon-trash " onclick='editar_reserva(<?php echo $reserva->id_temp ?>,0)' title='Eliminar'  style='color:#ff4444;font-size:100%' ></span>
							<?php } ?>
							<?php if(($permiso->nombre=="VER" && $reserva->idusu_temp==$_SESSION['id']) || $permiso->nombre=="VER GRAL" ){ ?>
								<span class="glyphicon glyphicon-eye-open" onclick='editar_reserva(<?php echo $reserva->id_temp ?>,2)' title='Ver'  style='color:blue;font-size:100%'></span>
							<?php } ?>
							<?php if($permiso->nombre=="COTIZACION"){ ?>
								<span  class="glyphicon glyphicon-resize-full" data-toggle="modal" data-target="#modal-confirmacion" onclick='abrir_modal("Cotización del vuelo <?php echo $reserva->id_temp ?>|0",<?php echo $reserva->id_temp ?>,"cotizacion.php")' title='Cotización'  ></span>
							<?php } ?>
							<?php if($permiso->nombre=="AGREGAR PAGO"){ ?>
								<span class="glyphicon glyphicon-usd" data-toggle="modal" data-target="#modal-confirmacion"  onclick='abrir_modal("Agregar Pago de <?php echo $reserva->nombre ?>|<?php echo $permiso->id; ?>",<?php echo $reserva->id_temp ?>,"pagos.php")' style="color: #00C851" title="Agregar Pago"></span>
							<?php } ?>
							<?php if($permiso->nombre=="CONCILIAR"){ ?>
								<span class="glyphicon glyphicon-check" data-toggle="modal" data-target="#modal-confirmacion"  onclick='abrir_modal("Conciliar Pago de <?php echo $reserva->nombre ?>|<?php echo $permiso->id; ?>",<?php echo $reserva->id_temp ?>,"pagos.php")' style="color: #5c6bc0 " title="Conciliar"></span>
							<?php } ?>
							<?php if($permiso->nombre=="BITACORA"){ ?>
								<span class="glyphicon glyphicon-list-alt" data-toggle="modal" data-target="#modal-confirmacion"  onclick='abrir_modal("Bitacora de Pagos de <?php echo $reserva->nombre; ?>|<?php echo $permiso->id; ?>",<?php echo $reserva->id_temp ?>,"pagos.php")' title="Bitacora de Pagos" style="color: #aa66cc"></span>
							<?php } ?>	
							<?php if($permiso->nombre=="CAMBIOS"){ ?>
								<span class="glyphicon glyphicon-refresh" data-toggle="modal" data-target="#modal-confirmacion"  onclick='abrir_modal("Confirmacion de Cambios para <?php echo $reserva->nombre; ?>|<?php echo $permiso->id; ?>",<?php echo $reserva->id_temp ?>,"cambios.php")' title="Bitacora de Cambios" style="color: #aa66cc"></span>
							<?php } ?>		
							<?php if($permiso->nombre=="PILOTOS"){ ?>
								<span class="glyphicon glyphicon-user" data-toggle="modal" data-target="#modal-confirmacion"  onclick='abrir_modal("Datos Extras para <?php echo $reserva->nombre;?>",<?php echo $reserva->id_temp ?>,"pilotos.php")' title="Asignar Pilotos" style="color: #aa66cc"></span>
							<?php } ?>	
						<?php } ?>
					<?php } ?>
					
					</div>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<script type="text/javascript">

	function editar_reserva(id,tipo){
		if(tipo==0){
			if(confirm("Eliminar el vuelo #"+id)){
				guardar_datos_temp("status",0,id);
			}
		}else if(tipo==1){
			if(confirm("Editar el vuelo #"+id)){
				$("#contenido").load("captura_nuevo/nuevo.php",{id:id});
			} 
		}else if(tipo==2){
				$("#contenido").load("captura_nuevo/nuevo.php",{id:id,tipo:0});
		}
	}
	function guardar_datos_temp(campo,value,act_temp){
		parametros={campo:campo,valor:value,id:act_temp,tipo:1};
		$.ajax({
			url:"captura_nuevo/temporal.php",
			method: "POST",
			async:false,
	  		data: parametros,
	  		success:function(response){
	  			console.log("Registro Eliminado " +response);
				$("#contenido").load("<?php echo $_SESSION['modulo']; ?>");
	  		},
	  		error:function(){
	  			alert("Error");
	  		},
	  		statusCode: {
			    404: function() {
			      alert( "No encuontoro el archivo de registro" );
			    }
			 }
		});
	}
</script>
<script type="text/javascript">
	tables();	
	function cargar_nuevo(url){
		$("#contenido").load("captura_nuevo/"+url);
	}
</script>
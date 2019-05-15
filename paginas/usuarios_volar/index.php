<?php 
	session_start();
	if(isset($_POST['idpagina'])){
		$_SESSION['idpagina']=$_POST['idpagina'];
	}
	$_SESSION['tabla']="volar_usuarios";
	$_SESSION['modulo']="usuarios_volar/";
	include_once "../../css/log/c/conexion.php";
	$campos="CONCAT(ifnull(nombre_usu,''),'-',ifnull(apellidop_usu,''),'-',ifnull(apellidom_usu,'')) as usuario, correo_usu, puesto_usu,depto_usu,id_usu";
	$filtro="status=1 ";
	$permisos=$cons->consultas("nombre_sp as nombre","permisosusuarios_volar pv,subpermisos_volar sv","id_sp=idsp_puv and idusu_puv=".$_SESSION['id']." and pv.status=1 and sv.status=1 and permiso_sp=".$_SESSION['idpagina'],"");
	$con=$cons->getconect();
	$stmt=$con->prepare("select nombre_extra from extras_volar where id_extra= :id");
	$stmt2=$con->prepare("select nombre_puesto from puestos_volar where id_puesto= :id");
	if(isset($_POST['fechaf'])){ 
		if(isset($_POST['fechai']) && $_POST['fechai']!=""){
			$filtro.=" and register>='".$_POST['fechai']." 00:00:00'";
		}
		if(isset($_POST['fechaf']) && $_POST['fechaf']!=""){
			$filtro.=" and register<'".$_POST['fechaf']." 23:59:59'";
		}
		if(isset($_POST['depto'])  && $_POST['depto']!="0"){
			$filtro.=" and depto_usu='".$_POST['depto']."'";
		}
		if(isset($_POST['usuario'])  && $_POST['usuario']!="0"){
			$filtro.=" and id_usu=".$_POST['usuario'];
		}
	}
	$empleados=$cons->consultas($campos,"volar_usuarios",$filtro,"");
	
	include "../../crud/fin_session.php";

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
			<th style="text-align: center;vertical-align: middle;max-width: 10%;width: 10%">Correo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 10%;width: 10%">Departamento</th>
			<th style="text-align: center;vertical-align: middle;max-width: 10%">Puesto</th>
			<th style="text-align: center;vertical-align: middle;max-width: 10%">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($empleados as $usuario) { ?>
			<tr>
				<td style="text-align: center;vertical-align: middle;max-width:30% ;width: 30%"><?php echo $usuario->usuario ?></td>
				<td style="text-align: center;vertical-align: middle;max-width:30% ;width: 30%"><?php echo $usuario->correo_usu ?></td>
				<?php 	
				if($usuario->depto_usu!="0"){
					$stmt->bindParam(":id",$usuario->depto_usu ,PDO::PARAM_INT);
					$stmt->execute();
					$resultado=$stmt->fetchALL (PDO::FETCH_OBJ);
					$depto=$resultado[0]->nombre_extra;
				}else{
					$depto="NA";
				}
				if($usuario->puesto_usu!="0"){
					$stmt2->bindParam(":id",$usuario->puesto_usu ,PDO::PARAM_INT);
					$stmt2->execute();
					$resultado2=$stmt2->fetchALL (PDO::FETCH_OBJ);
					$puesto=$resultado2[0]->nombre_puesto ;
				}else{
					$puesto="NA";
				}
				?>
				<td style="text-align: center;vertical-align: middle;max-width: 10%;width: 10%"><?php echo $depto; ?></td>
				<td style="text-align: center;vertical-align: middle;max-width: 10%"><?php echo $puesto;?></td>
				<td style="text-align: center;vertical-align: middle;max-width: 10%">
					<?php if(sizeof($permisos)>0){ ?>
						<?php foreach ($permisos as $permiso) { ?>
							<?php if($permiso->nombre=="EDITAR"){ ?>
								<span class="glyphicon glyphicon-edit" style="color: #33b5e5" onclick="editar_pagina(<?php echo $usuario->id_usu ?>,1,'<?php echo $usuario->usuario ?>')"></span>
							<?php } ?>
							<?php if($permiso->nombre=="ELIMINAR"){ ?>
								<span id="trash_<?php echo $usuario->id_usu; ?>" class='glyphicon glyphicon-trash' style='color:red' onclick='confirmar_icon(this.id,1)' >
		                      	</span>
		                      <div  style='display:none'>
		                          <span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick="actualizar_status(0,<?php echo $usuario->id_usu; ?>,'<?php echo $_SESSION["modulo"]?>',<?php echo $_SESSION['idpagina']?>)"></span>
		                        <span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id="opc_<?php echo $usuario->id_usu?>" onclick='confirmar_icon(this.id,0)'></span>
		                      </div>
							<?php } ?>
							<?php if($permiso->nombre=="VER"){ ?>
								<span class="glyphicon glyphicon-eye-open" style="color: #880e4f " onclick="editar_pagina(<?php echo $usuario->id_usu ?>,2,'<?php echo $usuario->usuario ?>')"></span>
							<?php } ?>
							<?php if($permiso->nombre=="PERMISOS"){ ?>
								<span class="glyphicon glyphicon-th-list" title="Agregar Permisos" style="color: #aa66cc" onclick="editar_pagina(<?php echo $usuario->id_usu ?>,3,'<?php echo $usuario->usuario ?>')"></span>
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
	function editar_pagina(id,tipo,nombre){
		if(tipo==0){
			if(confirm("Desea Eliminar "+nombre)){
				alert("Por el momento no se puede eliminar");
			}
		}else if(tipo==1){
			if(id!=0){
				$("#contenido").load("usuarios_volar/form.php",{id:id});
			}else{
				$("#contenido").load("usuarios_volar/form.php");
			}
			 
		}else if(tipo==2){			
				$("#contenido").load("usuarios_volar/form.php",{id:id,bloqueado:0});
		}else if(tipo==3){			
				$("#contenido").load("usuarios_volar/form1.php",{id:id,permisos:1},function(response, status, xhr){
					if ( xhr.status == 404 ) {
					    $( "#contenido" ).html("<img src='../img/404.jpg' style='margin-left:20%;margin-rigth:20%;width:60%'>");
					}
				});
		}
	}
</script>

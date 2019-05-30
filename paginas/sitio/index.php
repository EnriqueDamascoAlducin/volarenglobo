<?php 
	if(!isset($_SESSION['id'])){
		session_start();	
	}
	if(isset($_POST['idpagina'])){
		$_SESSION['idpagina']=$_POST['idpagina'];
	}
	$_SESSION['modulo']="sitio/";
	$_SESSION['tabla']="";
	$_SESSION['extraquery']="";
	include_once "../../css/log/c/conexion.php";
	include "../../crud/fin_session.php";
	$permisos=$cons->consultas("nombre_sp as nombre","permisosusuarios_volar pv,subpermisos_volar sv","id_sp=idsp_puv and idusu_puv=".$_SESSION['id']." and pv.status=1 and sv.status=1 and permiso_sp=".$_SESSION['idpagina'],"");

	

?>
<nav class="navbar navbar-light bg-info">
	<div class="pull-left" style="margin-left: 5%;margin-top: 1%"> 
		<?php foreach ($permisos as $permiso) { 
			if(("GASTOS"== $permiso->nombre)){ ?>
		<label onclick="abrir_forms(0,'<?php echo $_SESSION['modulo'] ?>form.php')"><span class="glyphicon glyphicon-plus" style="color: #3F729B;width: 120%;max-width: 120%;margin-right: 15%;"></span>&nbsp;Agregar Gastos</label>
		<?php } 

			if(("GASTOS"== $permiso->nombre)){ ?>
		<label onclick="abrir_forms(0,'<?php echo $_SESSION['modulo'] ?>form1.php')"><span class="glyphicon glyphicon-plus" style="color: #3F729B;width: 120%;max-width: 120%;margin-right: 15%;"></span>&nbsp;Agregar Ventas</label>
		<?php } 

			if(("GASTOS"== $permiso->nombre)){ ?>
		<label onclick="abrir_forms(0,'<?php echo $_SESSION['modulo'] ?>form2.php')"><span class="glyphicon glyphicon-eye-open" style="color: #3F729B;width: 120%;max-width: 120%;margin-right: 15%;"></span>&nbsp;Ver Movimientos</label>
		<?php } }?>
	</div>
</nav>

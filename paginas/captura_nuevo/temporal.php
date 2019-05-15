<?php 
	include_once "../../css/log/c/conexion.php";
	if(!isset($_POST['servicio'])){
		session_start();
		$id=$_POST['id'];
	 	$campo=$_POST['campo'];
	 	$valor="'".$_POST['valor']."'";
	 	if($valor=="''"){
	 		$valor="null";
	 	}
	 	if($campo!="status"){
			$campo=$campo."_temp";
	 	}
	 	if($_POST['tipo']==1){
	 		$cons->consultas($campo."=".$valor,$_SESSION['tabla'],"id_temp=".$id,"update");
	 	}else{
	 		$cons->consultas("idres_bit,idusu_bit,campo_bit,valor_bit","bitacora_actualizaciones_volar",$id.",".$_SESSION['id'].",'".$campo."',".$valor."","insert");
	 	}
	 }else{
	 	$servicio=$_POST['servicio'];
	 	$valor=$_POST['valor'];
	 	$reserva=$_POST['reserva'];
	 	$tipo=$_POST['tipo'];
	 	$actualizar=$cons->consultas("cantidad_sv=".$valor,"servicios_vuelo_temp","idtemp_sv=".$reserva." and tipo_sv=".$tipo." and idservi_sv=".$servicio,"update");	 	
	 	
	 }
 	
?>
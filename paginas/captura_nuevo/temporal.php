<?php 
	include_once "../../css/log/c/conexion.php";
	include "../../crud/fin_session.php";
	if(!isset($_POST['servicio'])){
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
	 	$cantidad=$_POST['cantidad'];
	 	$reserva=$_POST['id'];
	 	$tipo=$_POST['tipo'];
	 	$validar_servicio=$cons->consultas("id_sv as id ","servicios_vuelo_temp","idtemp_sv=".$reserva." "." and idservi_sv=".$servicio,"");
	 	if(sizeof($validar_servicio)>0){
	 		$actualizar=$cons->consultas("cantidad_sv=".$cantidad.", tipo_sv = ".$tipo,"servicios_vuelo_temp","id_sv=".$validar_servicio[0]->id,"update");
	 	}else{
	 		$ingresar=$cons->consultas("idtemp_sv,idservi_sv,tipo_sv,cantidad_sv","servicios_vuelo_temp",$reserva.",".$servicio.",".$tipo.",".$cantidad,"insert");
	 	}	
	 }
 	
?>
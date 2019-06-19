<?php 
	$cambios=$cons->consultas("idvalid_bit=".$_SESSION['id'],"bitacora_actualizaciones_volar","id_bit=".$_POST['id'],"update");
	if($_POST['status']==2){
		$cambios=$cons->consultas("campo_bit, valor_bit,idres_bit","bitacora_actualizaciones_volar","id_bit=".$_POST['id'],"");
		$campo=$cambios[0]->campo_bit;
		$valor=$cambios[0]->valor_bit;
		$actualiza=$cons->consultas($campo."='".$valor."'","temp_volar","id_temp=".$cambios[0]->idres_bit,"update");
	}
?>
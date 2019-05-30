
<?php
	$campos_extra=['procedencia_temp','motivo_temp','tarifa_temp'];
	$cat_vuelos=['tipo_temp'];
	$hoteles=['hotel_temp'];
	$habitaciones=['habitacion_temp'];
	include_once "../../css/log/c/conexion.php";
	include "../../crud/fin_session.php";
	if(!isset($_SESSION['id'])){
		session_start();	
	}
	$_SESSION['tabla']="bitacora_actualizaciones_volar";
	
	$id=$_POST['id'];
	$titulo=explode("|",$_POST['titulo']);
	$_SESSION['extraquery']="../paginas/captura_nuevo/queries/query.php";
	$cambios=$cons->consultas("id_bit,idusu_bit,idvalid_bit,campo_bit,valor_bit,register","bitacora_actualizaciones_volar","status=1 and idres_bit=".$id,"");
	$con=$cons->getconect();
	$stmt=$con->prepare("select CONCAT(ifnull(nombre_usu,''),' ',ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'') )as nombre from volar_usuarios where id_usu= :idusu");
	$camps=$con->prepare("SHOW FULL COLUMNS from temp_volar where FIELD= :campo");
	$valor_actual=$cons->consultas("*","temp_volar","id_temp=".$id,"");
	function convertir_datos($valor){
		global $cons;
		$texto=$cons->consultas("nombre_extra","extras_volar","id_extra=".$valor,"");
		return $texto[0]->nombre_extra;
	}
	function convertir_tipos($valor){
		global $cons;
		$texto=$cons->consultas("nombre_vc","vueloscat_volar","id_vc=".$valor,"");
		return $texto[0]->nombre_vc;
	}
	function convertir_hoteles($valor){
		global $cons;
		$texto=$cons->consultas("nombre_hotel","hoteles_volar","id_hotel=".$valor,"");
		return $texto[0]->nombre_hotel;
	}
	function convertir_habitacion($valor){
		global $cons;
		$texto=$cons->consultas("nombre_habitacion","habitaciones_volar","id_vc=".$valor,"");
		return $texto[0]->nombre_habitacion;
	}
	
?>

<div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titulo_modal"><?php echo $titulo[0]; ?></h4>
      </div>
      <div class="modal-body cuerpo_modal" id="cuerpo_modal" style=''>

 			<table class="table" style="width: 100%;max-width: 100%">
 				<thead>
 					<tr>
	 					<th>
	 						Requerido por
	 					</th>
	 					<?php if($titulo[1]!=27){ ?>
	 						<th>Validado Por:</th>
	 					<?php } ?>
	 					<th>
	 						Dato Modificado
	 					</th>
	 					<th>
	 						Valor
	 					</th>
	 					<?php if($titulo[1]==27){ ?>
	 						<th>Acciones</th>
	 					<?php } ?>
	 				</tr>
 				</thead>
 				<tbody>
 					<?php foreach ($cambios as $cambio) {
 						$usu="No Asigando";
 						$field=$cambio->campo_bit;
 						$campo="";
 						echo '<tr>';
	 						if($cambio->idusu_bit!=NULL && $cambio->idusu_bit!="" && $cambio->idusu_bit!=0 ){
	 							$stmt->bindParam(":idusu",$cambio->idusu_bit,PDO::PARAM_STR);
								$stmt->execute();
								$resultado=$stmt->fetchALL (PDO::FETCH_OBJ);
								$usu=($resultado[0]->nombre);
	 						}
 							echo '<td>'.$usu.'</td>';
 							if($titulo[1]!=27){
 								if($cambio->idvalid_bit!=NULL && $cambio->idvalid_bit!="" && $cambio->idvalid_bit!=0 ){
		 							$stmt->bindParam(":idusu",$cambio->idvalid_bit,PDO::PARAM_STR);
									$stmt->execute();
									$resultado=$stmt->fetchALL (PDO::FETCH_OBJ);
									$usu=($resultado[0]->nombre);
		 						}
 								echo '<td>'.$usut.'</td>';
 							}
 							$camps->bindParam(":campo",$field,PDO::PARAM_STR);
							$camps->execute();
							$resultado=$camps->fetchALL (PDO::FETCH_OBJ);
							$campo=($resultado[0]->Comment);
							if(in_array($field, $campos_extra)){
								$valor=convertir_extras($valor_actual[0]->$field);
								$valor2=convertir_extras($cambio->valor_bit);
							}else if(in_array($field, $cat_vuelos)){
								$valor=convertir_tipos($valor_actual[0]->$field);
								$valor2=convertir_tipos($cambio->valor_bit);
							}else if(in_array($field, $hoteles)){
								$valor=convertir_hoteles($valor_actual[0]->$field);
								$valor2=convertir_hoteles($cambio->valor_bit);
							}else if(in_array($field, $habitaciones)){
								$valor=convertir_habitacion($valor_actual[0]->$field);
								$valor2=convertir_habitacion($cambio->valor_bit);
							}else{
								$valor=$valor_actual[0]->$field;
								$valor2=($cambio->valor_bit);

							}
 							echo '<td>'.$campo.'</td>';
 							echo '<td>
 									<label style="background:#ff4444;color:white;">'.$valor.'</label><br>';
 								echo'<label style="background:#00C851;color:white;">'.$valor2.'</label>';
 							echo '</td>';
 						
	 						if($titulo[1]==27){

		 						echo '<td>';
		 							echo " 
		 								<span id='trash_".$cambio->id_bit."' class='glyphicon glyphicon-trash' style='color:red' onclick='confirmar_icon(this.id,1)' >
	                      				</span>
	                      				<div  style='display:none'>
	                          				<span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick=actualizar_status(0,".$cambio->id_bit. ",'".$_SESSION['modulo']."',".$_SESSION['idpagina'].")></span>
	                        				<span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id='opc_".$cambio->id_bit."' onclick='confirmar_icon(this.id,0)'></span>
	                      				</div>";
		 							echo " 
		 								<span id='thumbs_".$cambio->id_bit."' class='glyphicon glyphicon-thumbs-up' style='color:#0099CC' onclick='confirmar_icon(this.id,1)' >
	                      				</span>
	                      				<div  style='display:none'>
	                          				<span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick=actualizar_status(2,".$cambio->id_bit. ",'".$_SESSION['modulo']."',".$_SESSION['idpagina'].")></span>
	                        				<span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id='opct_".$cambio->id_bit."' onclick='confirmar_icon(this.id,0)'></span>
	                      				</div>";
		 						echo '</td>';
		 					}
	 					echo '</tr>';
 					} ?>
 				</tbody>
 				
 			</table>
      </div>
      <div class="modal-footer">
      	
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>

<?php
	$id=$_POST['id'];
	$titulo=$_POST['titulo'];
	$permiso=explode("|", $titulo);
	if(isset($permiso[1])){
		$titulo=$permiso[0];
	}
	if(!isset($_SESSION['id'])){
		session_start();
	}
	if($id!=""){
		include_once "../../css/log/c/conexion.php";
		$principales=$cons->consultas("*","temp_volar","status<>0 and id_temp=".$id,"");
		$campos=$cons->consultas("show full columns","temp_volar","","");
		//$suma=$cons->consultas("sum(costo_sv) as total","servicios_vuelo_temp","status=2 and idtemp_sv=".$id,"");
		$servicios_suma=$cons->consultas("nombre_servicio,precio_servicio,tipo_sv,cantidad_sv","servicios_vuelo_temp svt ,servicios_volar sv","id_servicio=idservi_sv and cantidad_sv>0 and idtemp_sv=".$id,"");
		if($principales[0]->habitacion_temp!=NULL && $principales[0]->habitacion_temp!="" && $principales[0]->habitacion_temp !="0"){
			$direccion=" CONCAT ('Calle: ',ifnull(calle_hotel,'NA'),', No. int.',ifnull(noint_hotel,'NA'),', No. ext.',ifnull(noext_hotel,'NA'),', Colonia:', ifnull(colonia_hotel,'NA'),', Municipio:', ifnull(municipio_hotel,'NA'),', ' ,(SELECT nombre_extra from extras_volar where id_extra=estado_hotel),', CP:', ifnull(cp_hotel,'NA') ) as direccion";
			$habitaciones=$cons->consultas("nombre_habitacion as habitacion, precio_habitacion as precio, capacidad_habitacion as capacidad, descripcion_habitacion as descripcion,nombre_hotel as hotel,".$direccion,"hoteles_volar hv, habitaciones_volar h","idhotel_habitacion=id_hotel and id_habitacion=".$principales[0]->habitacion_temp,"");
		}
		$tipo_vuelo=$cons->consultas("*","vueloscat_volar","status=1 and id_vc=".$principales[0]->tipo_temp,"");
		$precionino=$tipo_vuelo[0]->precion_vc;
		$precioadulto=$tipo_vuelo[0]->precioa_vc;
		$totalpn=$precionino*$principales[0]->pasajerosn_temp;
		$totalpa=$precioadulto*$principales[0]->pasajerosa_temp;
		$totalvoletos=$totalpa+$totalpn;
		$preciototal=$totalvoletos;
		$servicios=$cons->consultas("nombre_cat as nombre","cat_servicios_volar csv,rel_catvuelos_volar rcv"," csv.status<>0 and rcv.status<>0 and id_cat=idcat_rel and idvc_rel=".$principales[0]->tipo_temp,"");
	}

include "../../crud/fin_session.php";
?>
<style type="text/css">
	.tdtitulo{
		background: #7986cb ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}
	.tdseparador{
		background: #2BBBAD ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}
	.tdtotal{
		background: #9933CC ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}
	.tddesc{
		background: #c51162 ;
		text-align: center;
		vertical-align: middle;
		color: white;	
	}
</style>
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titulo_modal"><?php echo $titulo; ?></h4>
      </div>
      <div class="modal-body cuerpo_modal" id="cuerpo_modal" style=''>
      	
<?php if ($id!=""){ ?> 
		<table class="tabla" style="max-width: 100%;width: 100%; border-color: #673ab7;max-height: 100%;height: 100%;overflow-y: scroll; " border="3" id="tablareservacion" >
			<thead>
				<tr>
					<th colspan="2" class="tdseparador" style="text-align: center;">Reserva No. <?php echo $principales[0]->id_temp ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tdtitulo">Fecha de Vuelo</td>
						<?php if( $principales[0]->fechavuelo_temp=="0000-00-00" ||  $principales[0]->fechavuelo_temp==null){
							$fecha="No Asignada";
						}else{
							$fecha= $principales[0]->fechavuelo_temp;
						} ?>
					<td><?php echo  $fecha ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Nombre</td>
					<td><?php echo ( $principales[0]->nombre_temp." ".$principales[0]->apellidos_temp) ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Correo</td>
					<td><?php echo (  $principales[0]->mail_temp) ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Telefono Fijo - Telefono Celular</td>
					<td><?php echo $principales[0]->telfijo_temp." - ".$principales[0]->telcelular_temp ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Tipo de Vuelo</td>

					<td><?php echo ( $tipo_vuelo[0]->nombre_vc) ."<br>Adultos($".
					number_format($precioadulto, 2, '.', ',')."), Niños ($".number_format($precionino, 2, '.', ',').")";	 ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Pasajeros</td>
					<td><?php echo "Adultos ".$principales[0]->pasajerosa_temp." - Niños ".$principales[0]->pasajerosn_temp. " <br>($".number_format($totalvoletos, 2, '.', ',').")"; ?></td>
				</tr>
				<?php if(!is_null($principales[0]->otroscar1_temp)) { ?>
				<tr>
					<td  class="tdtitulo">
						Otros Cargos
					</td>
					<td><?php echo $principales[0]->otroscar1_temp . "($".  number_format($principales[0]->precio1_temp, 2, '.', ',') .")";   ?></td>
				</tr>
				<?php $preciototal=$preciototal+$principales[0]->precio1_temp; } ?>
				<?php if(!is_null($principales[0]->otroscar2_temp)) { ?>
				<tr>
					<td  class="tdtitulo">
						Otros Cargos
					</td>
					<td><?php echo $principales[0]->otroscar2_temp . "($". number_format($principales[0]->precio2_temp, 2, '.', ',') .")";   ?></td>
				</tr>
				<?php $preciototal=$preciototal+$principales[0]->precio2_temp; } ?>

				
					
				
				<!-- <tr>
					<td class="tdtitulo" colspan="2">Servicios Solicitados	</td>
				</tr>					
				<?php foreach ($servicios as $servicio) { ?>
					<tr>
				<?php	echo "<td colspan='2'>".$servicio->nombre."</td>"; ?>
					</tr>
				<?php } ?> -->
				<tr>
					<td class="tdseparador" colspan="2">Servicios Solicitados	</td>
				</tr>
				<tr>
					<td colspan="2">
					<?php foreach ($servicios_suma as $servicio_suma) {
						if($servicio_suma->tipo_sv==1){
						echo "<tr >";
							echo "<td class='tdtitulo'>".$servicio_suma->nombre_servicio."</td>";
							echo "<td>".$servicio_suma->precio_servicio."*".$servicio_suma->cantidad_sv."</td>";
						echo "</tr>";
						$preciototal=$preciototal+($servicio_suma->precio_servicio*$servicio_suma->cantidad_sv);
					}else{
						echo "<tr>";
							echo "<td class='tdtitulo'>".$servicio_suma->nombre_servicio."</td>";
							echo "<td>Cortesia * ".$servicio_suma->cantidad_sv."</td>";
						echo "</tr>";
					}
					}
					?>
					</td>
				</tr>
				<?php if (isset($habitaciones)){ ?>
				<tr>
					<td colspan="2"  class='tdseparador'>Hospedaje</td>
				</tr>
				<?php foreach ($habitaciones as $habitacion) {
					echo "<tr>";
						echo "<td  class='tdtitulo'>Hotel</td>";
						echo "<td  >".$habitacion->hotel."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td colspan='2' >".utf8_encode($habitacion->direccion)."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  class='tdtitulo'>Habitacion</td>";
						echo "<td  >".utf8_encode($habitacion->habitacion)."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  class='tdtitulo'>Capacidad</td>";
						echo "<td  >".$habitacion->capacidad."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  class='tdtitulo'>Descripción</td>";
						echo "<td  >". utf8_encode($habitacion->descripcion)."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  class='tdtitulo'>Precio/Noche</td>";
						echo "<td  >". $habitacion->precio."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  class='tdtitulo'>Estadia</td>";
						$inicio = new DateTime($principales[0]->checkin_temp);
						$final = new DateTime($principales[0]->checkout_temp);
						$diff = $inicio->diff($final);
						echo "<td  >".$diff->days." días (".$principales[0]->checkin_temp." a ".$principales[0]->checkout_temp.")->".$habitacion->precio*$diff->days."</td>";
						
						$preciototal=$preciototal+($habitacion->precio*$diff->days);
					echo "</tr>";
				} ?>
				<?php } ?>
				<tr>
					<td class="tdtotal">Sub Total</td>
					<td> <?php echo  "$". number_format($preciototal, 2, '.', ',') ?> </td>
				</tr>
				<?php
				if(!is_null($principales[0]->tdescuento_temp)) {
					$cuerpo='<tr>
								<td class="tddesc">Descuento</td>';
					if  ($principales[0]->tdescuento_temp==1){
						$cuerpo.='<td>'.$principales[0]->cantdescuento_temp.'% </td>';
						$pesosdesc=$preciototal*($principales[0]->cantdescuento_temp/100);
						$preciototal=$preciototal-$pesosdesc;
					}else{
						$cuerpo.='<td class="tddesc"> $'.number_format($principales[0]->cantdescuento_temp, 2, '.', ',').'</td>';
						$preciototal=$preciototal- $principales[0]->cantdescuento_temp;
					}

					$cuerpo.='</tr>';
					echo $cuerpo;
				}
				?>
				<tr>
					<td class="tdtotal">Total</td>
					<td> <?php echo "$". number_format($preciototal, 2, '.', ',') ?> </td>
				</tr>
			</tbody>
		</table>
		<?php } ?>
      </div>
      <div class="modal-footer">
      	<?php if ($id!="") { ?>
      		<?php if(!isset($permiso[1])){ ?>
	
      		<button type="button" class="btn btn-info" data-dismiss="modal" onclick="enviar_cotizacion(<?php echo "'".$_SESSION['modulo']."'" ?>,<?php echo $_SESSION['idpagina']; ?>);">Confirmar</button>
      		<?php } ?>
      	<?php } ?>
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
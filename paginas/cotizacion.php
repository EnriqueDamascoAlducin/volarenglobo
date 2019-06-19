<?php
	$id=$_POST['id'];
	$titulo=$_POST['titulo'];
	if($id!=""){


		include_once "../css/log/c/conexion.php";
		$principales=$cons->consultas("*","temp_volar","status<>0 and id_temp=".$id,"");
		$campos=$cons->consultas("show full columns","temp_volar","","");
		$suma=$cons->consultas("sum(costo_sv) as total","servicios_vuelo_temp","status=2 and idtemp_sv=".$id,"");
		 $tipo_vuelo=$cons->consultas("*","vueloscat_volar","id_vc=".$principales[0]->tipo_temp,"");
		$precionino=$tipo_vuelo[0]->precion_vc;
		$precioadulto=$tipo_vuelo[0]->precioa_vc;
		$totalpn=$precionino*$principales[0]->pasajerosn_temp;
		$totalpa=$precioadulto*$principales[0]->pasajerosa_temp;
		$totalvoletos=$totalpa+$totalpn;
		$preciototal=$totalvoletos;
	}
?>
<style type="text/css">
	.tdtitulo{
		background: #7986cb ;
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
		<table class="tabla" style="max-width: 100%; border-color: #673ab7 " border="3" id="tablareservacion" >
			<thead>
				<tr>
					<th colspan="2" style="text-align: center;">Reserva No. <?php echo $principales[0]->id_temp ?></th>
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
					<td><?php echo utf8_encode( $principales[0]->nombre_temp." ".$principales[0]->apellidos_temp) ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Correo</td>
					<td><?php echo utf8_encode(  $principales[0]->mail_temp) ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Telefono Fijo - Telefono Celular</td>
					<td><?php echo $principales[0]->telfijo_temp." - ".$principales[0]->telcelular_temp ?></td>
				</tr>
				<tr>
					<td class="tdtitulo">Tipo de Vuelo</td>

					<td><?php echo utf8_encode( $tipo_vuelo[0]->nombre_vc) ."<br>Adultos($".
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

				
				<tr>
					<td class="tdtitulo">Servicios Solicitados</td>
					<td> <?php echo "$".number_format($suma[0]->total, 2, '.', ',') ; ?> </td>
					<?php $preciototal=$preciototal+$suma[0]->total; ?>
				</tr>
				<tr>
					<td class="tdtitulo">Sub Total</td>
					<td> <?php echo  "$". number_format($preciototal, 2, '.', ',') ?> </td>
				</tr>
					
				<tr>
					<td class="tdtitulo">Total</td>
					<td> <?php echo "$". number_format($preciototal, 2, '.', ',') ?> </td>
				</tr>
			</tbody>
		</table>
		<?php } ?>
      </div>
      <div class="modal-footer">
      	<?php if ($id!="") { ?>
      		<button type="button" class="btn btn-info" data-dismiss="modal" onclick="enviar_cotizacion();">Confirmar</button>
      	<?php } ?>
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
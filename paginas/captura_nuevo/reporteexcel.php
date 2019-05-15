<?php
include_once "../../css/log/c/conexion.php";
$filtro="tv.status <>0 and tv.idusu_temp=vu.id_usu";
$campos ="id_temp as reserva,CONCAT(ifnull(nombre_usu,''),' ', ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'')) as vendedor,
    CONCAT(ifnull(nombre_temp,''),' ',ifnull(apellidos_temp,'')) as cliente,
    mail_temp as correo,
    CONCAT( ifnull(telfijo_temp,''),' / ',ifnull(telcelular_temp,'') )as telefono,
    ifnull((SELECT nombre_extra from extras_volar where id_extra=procedencia_temp),'') as procedencia,
    ifnull(pasajerosa_temp,'')as adultos,
    ifnull(pasajerosn_temp,'')as ninos,
     ifnull((SELECT nombre_extra from extras_volar where id_extra=motivo_temp),'') as motivo,
    ifnull((SELECT nombre_vc from vueloscat_volar where id_vc=tipo_temp),'') as tipo,
    ifnull(fechavuelo_temp,'') as fechavuelo,
    ifnull((SELECT nombre_hotel from hoteles_volar where id_hotel=hotel_temp),'') as hotel,
    ifnull((SELECT nombre_habitacion from habitaciones_volar where id_habitacion=habitacion_temp),'') as habitacion,
    ifnull(total_temp,'0') as cotizado,
    ifnull((SELECT CONCAT(ifnull(nombre_usu,''),' ', ifnull(apellidop_usu,''),' ',ifnull(apellidom_usu,'')) from volar_usuarios where id_usu=piloto_temp),'') as piloto,
    ifnull((SELECT nombre_globo from globos_volar where id_globo=globo_temp),'') as globo,
    ifnull(kg_temp,'NA') as peso, tv.status";
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
		$filtro.=" and tv.status='".$_POST['status']."'";
	}
	if(isset($_POST['empleados'])){
		if($_POST['empleados']!="" && $_POST['empleados']!="0"){
			$filtro.=" and idusu_temp='".$_POST['empleados']."'";
		}
	}
	if($_POST['reserva']!=""){
		$filtro.=" and id_temp=".$_POST['reserva'];
	}
}
$fila=3;
$titulo=1;
$enc=2;
$reservas=$cons->consultas($campos,"volar_usuarios vu, temp_volar tv ",$filtro,"");
include '../../excel/Classes/PHPexcel.php';
$objphp= new PHPExcel();
$objphp->getProperties()
        ->setCreator("Volar en Globo")
        ->setLastModifiedBy("Volar en Globo")
        ->setTitle("Reporte de vuelos")
        ->setSubject("Reporte de Vuelos")
        ->setDescription("Reporte de Vuelos de Volar en Globo")
        ->setKeywords("vuelos reservas")
        ->setCategory("Vuelos");
$objphp->setActiveSheetIndex(0);
$objphp->getActiveSheet()->setTitle('Hoja 1');
$objphp->getActiveSheet()->setCellValue('A'.$titulo,'Reporte de Vuelos de Volar en Globo');
$objphp->getActiveSheet()->mergeCells('A'.$titulo.':L'.$titulo);
$objphp->getActiveSheet()->setCellValue('A'.$enc, 'Reserva');
$objphp->getActiveSheet()->setCellValue('B'.$enc, 'Nombre');
$objphp->getActiveSheet()->setCellValue('C'.$enc, 'Vendedor');
$objphp->getActiveSheet()->setCellValue('D'.$enc, 'Correo');
$objphp->getActiveSheet()->setCellValue('E'.$enc, 'Telefonos Fijo/Celular');
$objphp->getActiveSheet()->setCellValue('F'.$enc, 'Fecha de Vuelo');
$objphp->getActiveSheet()->setCellValue('G'.$enc, 'Procedencia');
$objphp->getActiveSheet()->setCellValue('H'.$enc, 'P. Adultos');
$objphp->getActiveSheet()->setCellValue('I'.$enc, 'P. Niños');
$objphp->getActiveSheet()->setCellValue('J'.$enc, 'Motivo');
$objphp->getActiveSheet()->setCellValue('K'.$enc, 'Tipo');
$objphp->getActiveSheet()->setCellValue('L'.$enc, 'Hotel');
$objphp->getActiveSheet()->setCellValue('M'.$enc, 'Habitación');
$objphp->getActiveSheet()->setCellValue('N'.$enc, 'Cotizado');
$objphp->getActiveSheet()->setCellValue('O'.$enc, 'Globo');
$objphp->getActiveSheet()->setCellValue('P'.$enc, 'Peso (kg)');
$objphp->getActiveSheet()->setCellValue('Q'.$enc, 'Status');
foreach ($reservas as $reserva) {

$objphp->getActiveSheet()->setCellValue('A'.$fila, $reserva->reserva );
$objphp->getActiveSheet()->setCellValue('B'.$fila, $reserva->cliente );
$objphp->getActiveSheet()->setCellValue('C'.$fila, $reserva->vendedor );
$objphp->getActiveSheet()->setCellValue('D'.$fila, $reserva->correo );
$objphp->getActiveSheet()->setCellValue('E'.$fila, $reserva->telefono);
$objphp->getActiveSheet()->setCellValue('F'.$fila, $reserva->fechavuelo);
$objphp->getActiveSheet()->setCellValue('G'.$fila, utf8_encode($reserva->procedencia) );
$objphp->getActiveSheet()->setCellValue('H'.$fila, $reserva->adultos );
$objphp->getActiveSheet()->setCellValue('I'.$fila, $reserva->ninos );
$objphp->getActiveSheet()->setCellValue('J'.$fila, utf8_encode($reserva->motivo) );
$objphp->getActiveSheet()->setCellValue('K'.$fila, utf8_encode($reserva->tipo) );
$objphp->getActiveSheet()->setCellValue('L'.$fila, utf8_encode($reserva->hotel) );
$objphp->getActiveSheet()->setCellValue('M'.$fila, utf8_encode($reserva->habitacion) );
$objphp->getActiveSheet()->setCellValue('N'.$fila, $reserva->cotizado );
$objphp->getActiveSheet()->setCellValue('O'.$fila, utf8_encode($reserva->globo) );
$objphp->getActiveSheet()->setCellValue('P'.$fila, $reserva->peso );
if( $reserva->status ==4){
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
$objphp->getActiveSheet()->setCellValue('Q'.$fila, $text );
$fila++;
}
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="Excel.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objphp, 'Excel2007');
$objWriter->save('php://output');
?>
<?php if (!true){ ?>
 <!-- 
<div id="tabla-reservas">
	<table class="table DataTable display" border="2" >
	<thead>
		<tr>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;"># Reserva</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Nombre</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Empleado</th>
			
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Correo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Telefonos Fijo/Celular</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Fecha de Vuelo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Procedencia</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">P. Adultos</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">P. Ninos</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Motivo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Tipo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Hotel</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Habitacion</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Cotizado</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Piloto</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Globo</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%">Peso (kg)</th>
			<th style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;">Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($reservas as $reserva) { ?>
			<tr>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->reserva ?></td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->cliente ?></td>

				
				<td style="text-align: center;vertical-align: middle;max-width: 1%;width: 1%;"><?php echo $reserva->vendedor; ?></td>
				
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->correo ?></td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->telefono ?></td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->fechavuelo;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->procedencia;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->adultos;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->ninos;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->motivo;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->tipo;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->hotel;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->habitacion;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->cotizado;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->piloto;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->globo;?> 
				</td>
				<td style="max-width: 1%;width: 1%;text-align: center;vertical-align: middle;"><?php echo $reserva->peso;?> 
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
					    <?php echo $text; ?>
					  
				</td>

				
			</tr>
		<?php } ?>
	</tbody>
</table>
</div> -->
<?php } ?>
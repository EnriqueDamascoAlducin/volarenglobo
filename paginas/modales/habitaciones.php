
<?php
	include_once "../../css/log/c/conexion.php";
	include "../../crud/fin_session.php";
	session_start();
	$_SESSION['tabla']="habitaciones_volar";
	$id=$_POST['id'];
	$titulo=$_POST['titulo'];
	$habitaciones=$cons->consultas("*",$_SESSION['tabla'],"status<>0 AND idhotel_habitacion=".$id,"");
	$datos="";
	$size=[3,4,4,4,4,12,3,3,3,3,3,3,3,3,3,3];
  $type=[1,1,1,2,2,5,1,1,1,1,1,1,1,1,4,4];
 	$options=["1","2","3","2","","6","7","8","","10","","12","","",15];
	$extraprop=["required","required","required","required","required","required","required","required","","","","","","","","","",""];
 	$array=["id_habitacion","idhotel_habitacion","idreg_bp","register","status"];
	include "../../dinamicos/inputs.php";
?>

<div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titulo_modal"><?php echo $titulo; ?></h4>
      </div>
      <div class="modal-body cuerpo_modal" id="cuerpo_modal" style=''>
      		<form name="formularioext" id="formularioext" method="POST" style="margin-bottom: 10%">
      			<?php
      			echo "<input type='hidden' name='idhotel' value='".$id."'>";
      			$cont=0; 
                foreach ($campos as $campo) {
                  if(!in_array($campo->Field, $array)){
                    campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
                  }
                  $cont++;
                }

      			?>

      		</form>
      		<table class="table DataTable">
      			<thead>
      				<tr>
      					<th>Habitación</th>
      					<th>Capacidad</th>
      					<th>Precio</th>
      					<th>Acciones</th>
      				</tr>
      			</thead>
      			<tbody>
      				<?php foreach ($habitaciones as $habitacion) { ?>
      				<tr>
      					<td><?php echo $habitacion->nombre_habitacion; ?></td>
      					<td><?php echo $habitacion->capacidad_habitacion; ?></td>
      					<td>$ <?php echo $habitacion->precio_habitacion; ?></td>
      					<th>Acciones</th>
      				</tr>
      				<?php } ?>
      			</tbody>
      		</table>	
      </div>
      <div class="modal-footer">
      	
        
        <button type="button" class="btn btn-primary"   onclick="save_extra(<?php echo "'".$_SESSION['modulo']."'".",".$_SESSION['idpagina']; ?>,<?php echo "'".$_POST['titulo']."',".$id.",'habitaciones.php'"; ?>)" >Enviar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
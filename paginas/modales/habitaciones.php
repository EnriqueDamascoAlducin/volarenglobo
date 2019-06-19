
<?php
	include_once "../../css/log/c/conexion.php";
	include "../../crud/fin_session.php";
	
	$_SESSION['tabla']="habitaciones_volar";
	$id=$_POST['id'];
	$titulo=$_POST['titulo'];
  $datos="";
  
	$habitaciones=$cons->consultas("*",$_SESSION['tabla'],"status<>0 AND idhotel_habitacion=".$id,"");
	if(isset($_POST['idsub'])){
    $datos=$cons->consultas("*","habitaciones_volar","id_habitacion=".$_POST['idsub'],"");
  }
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
            if(isset($_POST['idsub'])){
              $datos=$cons->consultas("*","habitaciones_volar","id_habitacion=".$_POST['idsub'],"");
              echo "<input type='hidden' name='id' value='".$_POST['idsub']."'>";
            }
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
      					<th>

                <span class="glyphicon glyphicon-edit" style="color: #33b5e5" onclick="abrir_modal(' <?php echo $titulo; ?>',<?php echo $id ?>,'habitaciones.php',<?php echo $habitacion->id_habitacion ?>)"></span>
              
                  <span id='trash_<?php echo $habitacion->id_habitacion ?>' class='glyphicon glyphicon-trash' style='color:red' onclick='confirmar_icon(this.id,1)' >
                  </span>
                <div  style='display:none'>
                    <span class='glyphicon glyphicon-ok-circle' data-dismiss='modal'  style='color:#00C851;font-size:16px' onclick="actualizar_status(0,<?php echo $habitacion->id_habitacion ?>,'<?php echo $_SESSION["modulo"]?>',<?php echo $_SESSION['idpagina'] ?>)"></span>
                  <span class='glyphicon glyphicon-remove-circle' style='color:#ffbb33;font-size:16px' id='opc_<?php echo $habitacion->id_habitacion ?>' onclick='confirmar_icon(this.id,0)'></span>
                </div>
              
                </th>
      				</tr>
      				<?php } ?>
      			</tbody>
      		</table>	
      </div>
      <div class="modal-footer">
      	
        <?php if(!isset($_POST['idsub'])){ ?>
          <button type="button" class="btn btn-primary"   onclick="save_extra(<?php echo "'".$_SESSION['modulo']."'".",".$_SESSION['idpagina']; ?>,<?php echo "'".$_POST['titulo']."',".$id.",'habitaciones.php'"; ?>)" >Enviar</button>
        <?php } else{ ?>
          <button type="button" class="btn btn-info"   onclick="save_extra(<?php echo "'".$_SESSION['modulo']."'".",".$_SESSION['idpagina']; ?>,<?php echo "'".$_POST['titulo']."',".$id.",'habitaciones.php'"; ?>)" >Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
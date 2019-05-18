
<?php
	include_once "../../css/log/c/conexion.php";
	session_start();
  $_SESSION['extraquery']="";
  include "../../crud/fin_session.php";
	$_SESSION['tabla']="volar_usuarios";
  $_SESSION['idpagina']=0;
	$id=$_POST['id'];
  $titulo=$_POST['titulo'];
	$datos="";
	$size=[3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,1,1,1,1,1,1,1,1,1,1,3,3,3,3,3];
  $type=[1,3,3,3,3,3,3,3,3,3,3,3,13,3,3,3,1,1,1,1,1,1,1,1,1,1,0,4,4,12,2];
 	$options=["1","2","3","2"];
	$extraprop=["required","required","required","required","required","required","required","required","","","","","","","","","","","","","","","","","","","","","","","","","",""];
 	$array=["contrasena_usu"];
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
      			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
      <?php $cont=0; foreach ($campos as $campo) {
        if(in_array($campo->Field, $array)){
        campos($type[$cont],$campo->Comment,$campo->Field,$size[$cont],$options[$cont],$datos,$extraprop[$cont],$cons);
        $cont++;
        }
      } ?>

      		</form>
      		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"   onclick="save_extra(<?php echo "'".$_SESSION['modulo']."login.php'".",".$_SESSION['idpagina']; ?>,<?php echo "'".$_POST['titulo']."',".$id.",'pilotos.php'"; ?>)" >Asignar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
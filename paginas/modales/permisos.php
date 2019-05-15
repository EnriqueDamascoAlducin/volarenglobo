<?php
	$id=$_POST['id'];
	$titulo=explode("|",$_POST['titulo']);
	include_once "../../css/log/c/conexion.php";
  include "../../crud/fin_session.php";
  $subpermisos=$cons->consultas("nombre_sp,id_sp","subpermisos_volar","status=1 and permiso_sp=".$id,""); 

  $_SESSION['tabla']="permisosusuarios_volar";
  $_SESSION['extraquery']="";
?>
<div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titulo_modal"><?php echo $titulo[0]; ?></h4>
      </div>
      <div class="modal-body " id="cuerpo_modal" >
      	<form name="formularioext" id="formularioext">
          <input type="hidden" name="modulo" value="<?php echo $id; ?>">
          <input type="hidden" name="usuario" value="<?php echo $titulo[1]; ?>">
          <?php foreach($subpermisos as $subpermiso){ ?>
            <?php 
            $color="#ff4444";
            $check="";
            $subusuarios=$cons->consultas("id_puv","permisosusuarios_volar","status=1 and idsp_puv=".$subpermiso->id_sp." and idusu_puv=".$titulo[1],""); 
            if(!empty($subusuarios)){
              $color="#00C851";
              $check="checked";
            }
            ?>
      	  <div class=" col-sm-3 col-lg-3 col-md-3">
            <div class="form-group">
              <label for="check<?php echo $subpermiso->id_sp; ?>"><span id="spancheck<?php echo $subpermiso->id_sp; ?>" style="color:<?php echo $color; ?>" class="glyphicon glyphicon-check" style="font-size: 150%"></span> <?php echo $subpermiso->nombre_sp; ?></label>
              <input type="checkbox" <?php echo $check; ?> class="form-control" style="display: none;" name="check<?php echo $subpermiso->id_sp; ?>" onclick='agregar_permisos(this.id)' id="check<?php echo $subpermiso->id_sp; ?>" value="<?php echo $subpermiso->id_sp; ?>">
            </div> 
          </div>
          <?php } ?>
      	</form>
      </div>
      <div class="modal-footer">
      		
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function agregar_permisos(id){
      
      if($("#"+id).is(":checked")){
        $("#span"+id).css("color","#00C851");
        
      }else{
        $("#span"+id).css("color","#ff4444");
      }
      upd_permisos();
    }
  </script>
  <script type="text/javascript">
  function upd_permisos(){
    param=$("#formularioext").serialize();
    
    url="usuarios_volar/registro1.php";
    $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: param, 
           success: function(data)             
           {
            if(data.includes("Actualizado")){
              alert("Permisos Actualizados");              
            }
           }
       });
    setTimeout(function(){
      abrir_modal(<?php echo "'".$_POST['titulo']."',".$id.",'permisos.php'"; ?>);
    },500);
  }
</script>
  
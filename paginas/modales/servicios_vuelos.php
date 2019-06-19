<?php
	$id=$_POST['id'];
	$titulo=$_POST['titulo'];
	include_once "../../css/log/c/conexion.php";
  
  include "../../crud/fin_session.php";
	$servicios=$cons->consultas("nombre_cat,id_cat","cat_servicios_volar"," status=1 and id_cat not in(select idcat_rel from rel_catvuelos_volar where status=1 and idvc_rel=".$id.")","");
  $serviciossi=$cons->consultas("nombre_cat,id_cat","cat_servicios_volar csv,rel_catvuelos_volar rcv "," csv.status=1 and rcv.status=1 and rcv.idcat_rel=csv.id_cat and idvc_rel=".$id." order by rcv.register asc","");
?>
<div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titulo_modal"><?php echo $titulo; ?></h4>
      </div>
      <div class="modal-body cuerpo_modal" id="cuerpo_modal" style=''>
      	<form name="formularioext" id="formularioext">
      	<div class="col-sm-6 col-lg-6 col-md-6">
      		<div class="form-group">
      			<label for="cat">Agregar Servicios</label>
      			<select id="cat" name="cat" class="form-control">
      				<option value="">Agregar Servicios...</option>
      				<?php 
      				foreach ($servicios as $servicio) {
      					echo "<option value='".$servicio->id_cat."'>".$servicio->nombre_cat."</option>";
      				}
      				?>
      			</select>
      		</div>
      	</div>
      	<input type="hidden" name="idvc" id="idvc" value="<?php echo $id; ?>">
      	<table class="table display">
      		<thead>
      			<tr>
      				<th style='text-align: center;vertical-align: middle;'>Nombre</th>
      				<th style='text-align: center;vertical-align: middle;'>Acciones</th>
      			</tr>
      			
      		</thead>
      		<tbody>
      			<?php foreach ($serviciossi as $servicio) {
      				echo "<tr style='text-align: center;vertical-align: middle;'>
      							<td>".$servicio->nombre_cat."</td>
      							<td><span class='glyphicon glyphicon-trash' onclick=\"eliminar_servicio($servicio->id_cat)\" style='color:red'></span>
      					</tr>";
      			} ?>
      		</tbody>
      	</table>
      	</form>
      </div>
      <div class="modal-footer">
      		<button type="button" class="btn btn-info"  onclick="save_extra();">Registrar</button>
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  	function eliminar_servicio(id){
  		$("#formularioext").append("<input type='hidden' name='status' id='status' value='"+id+"'>");
     
        save_extra(); 
  		
  		$("#status").remove();
  	}
  	function save_extra(){
  	param=$("#formularioext").serialize();
		
		url="registro_cat_vuelos/registro.php";
		$.ajax({                        
           type: "POST",                 
           url: url,                     
           data: param, 
           success: function(data)             
           {
             alert(data);              
           }
       });
    setTimeout(function(){
      abrir_modal(<?php echo "'".$titulo."',".$id.",'servicios_vuelos.php'"; ?>);
    },500);
	}
  </script>
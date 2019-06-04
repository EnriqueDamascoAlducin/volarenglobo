<?php 
	if(!isset($_SESSION['id'])){
		session_start();	
	}
	include_once "../../css/log/c/conexion.php";
	$_SESSION['modulo']="catalogo_servicios/";
	$_SESSION['tabla']="cat_servicios_volar";
	if(isset($_POST['id'])){
		$_SESSION['idpagina']=$_POST['id'];
	}
	$servicios=$cons->consultas("*","cat_servicios_volar","status=1","");
?>
<form name="formulario" id="formulario">
<div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
	<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre" class="form-control">
	</div>
</div>
<button type="button" class="btn btn-success" onclick="enviar_crud(event,'<?php echo $_SESSION['modulo'] ?>',<?php echo $_SESSION['idpagina'] ?>)">Guardar</button>
</form>
<br><br><br><br>
<table class="table display DataTable" style="max-width: 30%">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($servicios as $servicio) {
			echo "<tr> 
					<td>".$servicio->nombre_cat."</td>";
			echo 	'<td>
						<span class="glyphicon glyphicon-trash" title="Eliminar" style="color: #ff4444"></span>';
			echo 		'<span class="glyphicon glyphicon-edit" title="Editar" 				style="color: #33b5e5"></span>';
			echo 	"</td>";
			echo "</tr>";
		} ?>
	</tbody>
</table>
<script type="text/javascript">
	tables();
</script>
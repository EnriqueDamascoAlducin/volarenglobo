<?php

		include_once "../../css/log/c/conexion.php";
	if(isset($_POST['id'])){
		$datos=$cons->consultas("*","vueloscat_volar","id_vc=".$_POST['id'],"");


	}$tipos=$cons->consultas("*","extras_volar","status=1 and clasificacion_extra='tiposv'","");
?>
<form name="formulario" id="formulario">
<div class="col-sm-12 col-md-3 col-lg-3 col-xs-12">
	<div class="form-group">
		<label for="nombre">Nombre del Vuelo</label>
		<input type="text" name="nombre" id="nombre" placeholder="Nombre del Vuelo" class="form-control" value="<?php
		if(isset($datos)){echo utf8_encode( $datos[0]->nombre_vc);}  ?> ">
	</div>
</div>
<div class="col-sm-12 col-md-3 col-lg-3 col-xs-12">
	<div class="form-group">
		<label for="tipo">Tipo de Vuelo</label>
		<select id="tipo" name="tipo" class="form-control">
			<option>Selecciona un Tipo</option>
			<?php foreach ($tipos as $tipo) {
				$attr="";
				if(isset($datos) && $datos[0]->tipo_vc==$tipo->id_extra ){$attr="selected";  }
				echo "<option $attr value='".$tipo->id_extra."'>".$tipo->nombre_extra."</option>";
			} ?>
		</select>
	</div>
</div>
<div class="col-sm-12 col-md-3 col-lg-3 col-xs-12">
	<div class="form-group">
		<label for="precioa">Precio de Adulto</label>
		<input type="number" name="precioa" min="0"  id="precioa" placeholder="Precio para Adulto" class="form-control" value="<?php
		if(isset($datos)){echo  $datos[0]->precioa_vc;} else{echo 0;} ?>">
	</div>
</div>
<div class="col-sm-12 col-md-3 col-lg-3 col-xs-12">
	<div class="form-group">
		<label for="precion">Precio de Niño</label>
		<input type="number" name="precion" on min="0"  id="precion" placeholder="Precio para Niño" class="form-control" value="<?php
		if(isset($datos)){echo  $datos[0]->precion_vc;} else{echo 0;}  ?>">
	</div>
</div>
<?php if(!isset($_POST['id']) ){ ?>
<button type="button" class="btn btn-success" onclick="save_Data(1)" >Agregar</button>
<?php } else if(!isset($_POST['tipo'])){ ?>
	<input type="hidden" name="id" id="id" value="<?php echo $_POST['id'];?>">
<button type="button" class="btn btn-info" onclick="save_Data(1)" >Actualizar</button>
<?php } ?>
</form>

<script type="text/javascript">
	function save_Data(tipo){
		if(tipo==1){
			param=$("#formulario").serialize();
		}else{
			param=$("#formularioext").serialize();
		}
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
	}
</script>
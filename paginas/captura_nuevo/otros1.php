<div class="col-sm-12 col-lg-12 col-md-12" style="background-color: #3674B2;color: white">
	Otros
</div>
	<div class="col-sm-12 col-lg-12 col-lg-12">
		<div class="form-group">
		    <label for="comentario">Comentarios:</label>
		    <textarea id="comentario" class="form-control" name="comentario" placeholder="Comentarios" style="width: 90%;height: 50px;resize: none; " ><?php if(isset($datos)){echo $datos[0]->comentario_temp;} ?></textarea>
   		</div>
  	</div>
  	<div class="col-sm-12 col-lg-6 col-lg-6">
		<div class="form-group">
		    <label for="otroscar1">Otros Cargos:</label>
		    <input type="text" name="otroscar1" id="otroscar1" value="<?php if(isset($datos)){echo $datos[0]->otroscar1_temp;} ?>" class= "form-control">
   		</div>
  	</div>
  	<div class="col-sm-12 col-lg-6 col-lg-6">
		<div class="form-group">
		    <label for="precio1">Precio:</label>
		    <input type="number" id="precio1" name="precio1" value="<?php if(isset($datos)){echo $datos[0]->precio1_temp;} ?>" class= "form-control">
   		</div>
  	</div>
  	<div class="col-sm-12 col-lg-6 col-lg-6">
		<div class="form-group">
		    <label for="otroscar2">Otros Cargos:</label>
		    <input type="text" id="otroscar2" name="otroscar2" value="<?php if(isset($datos)){echo $datos[0]->otroscar2_temp;} ?>" class= "form-control">
   		</div>
  	</div>
  	  	</div>
  	<div class="col-sm-12 col-lg-6 col-lg-6">
		<div class="form-group">
		    <label for="precio2">Precio:</label>
		    <input type="number" id="precio2" name="precio2" value="<?php if(isset($datos)){echo $datos[0]->precio2_temp;} ?>" class= "form-control">
   		</div>
  	</div>




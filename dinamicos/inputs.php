<?php 

$campos=$cons->consultas("show full columns",$_SESSION['tabla'],"","");
?>
<?php function campos($tipo ,$comentario,$campo2,$tamano,$options,$datos,$req,$cons){ ?>
	<?php 
		$color="style='color:black;text-align:center'";
		if (strpos($req, 'required') !== false) {
		    $color="style='color:red;text-align:center'";
		}
	?>
	<?php 
	$campo=explode("_", $campo2) [0];
	?>
	<?php if($tipo==1){ ?>
		<div  class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?> > <?php echo utf8_encode($comentario); ?></label>
				<input autocomplete="false" type="text"  name="<?php echo $campo ?>" placeholder="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>" value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo utf8_encode($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?> />
			</div>
		</div>
	<?php } else if($tipo==2) { ?>
		<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input autocomplete="false" type="number"  step=".01" name="<?php echo $campo ?>" placeholder="<?php echo utf8_encode($comentario)?>" class="form-control" id="<?php echo $campo; ?>" value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?>/>
			</div>
		</div>

	<?php }else if($tipo==3){ ?>
		<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo; ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<select class="form-control" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>">
					<option value=""><?php echo "Selecciona un ". utf8_encode($comentario); ?></option>
					<?php foreach ($options as $option) {
						if($option!=""){
							$attr="";
							if($option==$datos[0]->$campo2){
								$attr="selected";
							}
							echo "<option $attr>".$option."</option>";
						}
						
					} ?>
				</select>
			</div>
		</div>
	<?php  } else if ($tipo==4){ ?>
		<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			
			<div class="form-group">
				<label for="<?php echo $campo; ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<select class="form-control" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>" <?php echo $req; ?>>
					<option value="">Selecciona un <?php echo utf8_encode($comentario); ?></option>
					<?php $query=$cons->consultas($options[0],$options[1],$options[2],""); ?>
					<?php foreach ($query as $data) { ?>
						<?php 
						$attr="";
							if($data->value==$datos[0]->$campo2){
								$attr="selected";
							}
						?>
						<option value='<?php echo $data->value; ?>' <?php echo $attr; ?>><?php echo utf8_encode( $data->text); ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	<?php } else if($tipo==5){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-12" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<textarea   name="<?php echo $campo ?>" placeholder="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>" <?php echo $req; ?> ><?php if($datos!='' && $datos[0]->$campo2!=''){ echo utf8_encode($datos[0]->$campo2);}else{ echo '';} ?></textarea>
			</div>
		</div>
	
	<?php } else if($tipo==6){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-3" id="div_<?php echo $campo; ?>">
		<label for="<?php echo $campo ?>" <?php echo $color; ?>><img src="../img/modulos/globo.png" style="max-width: 100%;width: 100%" title="<?php echo ($comentario); ?>"></label>
			<input type="file" style="display: none" title="<?php echo utf8_encode($comentario) ?>"   name="<?php echo $campo ?>" placeholder="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>"  value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?> />
		</div>
	<?php } else if($tipo==7){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input type="date" autocomplete="false" name="<?php echo $campo ?>" placeholder="<?php echo  utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>"  value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?> />
			</div>
		</div>
	<?php } else if($tipo==8){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input autocomplete="false" type="datetime-local"  name="<?php echo $campo ?>" placeholder="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>"  value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?>/>
			</div>
		</div>
	<?php } else if($tipo==9){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input type="email" autocomplete="false" name="<?php echo $campo ?>" placeholder="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>" value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?> />
			</div>
		</div>
	<?php } else if($tipo==10){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input type="tel" autocomplete="false" name="<?php echo $campo ?>" title="(Ej.55-1234-5678)" placeholder="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>" value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?> pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" />
			</div>
	</div>
	<?php } else if($tipo==11){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input type="checkbox" autocomplete="false" name="<?php echo $campo ?>" title="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>" value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?> pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" />
			</div>
	</div>
	<?php } else if($tipo==12){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input type="time" autocomplete="false" name="<?php echo $campo ?>" title="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>" value="<?php if($datos!='' && $datos[0]->$campo2!=''){ echo($datos[0]->$campo2);}else{ echo '';} ?>"<?php echo $req; ?> pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" />
			</div>
	</div>
	
	<?php } else if($tipo==13){ ?>
	<div class="col-sm-<?php echo $tamano; ?> col-md-<?php echo $tamano; ?> col-lg-<?php echo $tamano; ?> col-xs-6" id="div_<?php echo $campo; ?>">
			<div class="form-group">
				<label for="<?php echo $campo ?>" <?php echo $color; ?>><?php echo utf8_encode($comentario); ?></label>
				<input type="password" autocomplete="false" name="<?php echo $campo ?>" title="<?php echo utf8_encode($comentario) ?>" class="form-control" id="<?php echo $campo; ?>" value="" />
			</div>
	</div>
	<?php } ?>
<?php } ?>

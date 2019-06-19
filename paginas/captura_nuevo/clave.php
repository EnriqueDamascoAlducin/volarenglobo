<div class="titulos-separadores">
	Busqueda de Datos por Clave
</div>
<table class="tabla">
	<tbody>
		<tr>
			<td >
				<small class="p">Ingresa la Clave: </small> 
				<input type="text" name="clave" id="clave" value="<?php if(isset($datos)){echo $datos[0]->clave_temp;} ?>">
			</td>
			<td>
				<button class="btn btn-info">Enviar</button>
			</td>
		</tr>
	</tbody>
</table>
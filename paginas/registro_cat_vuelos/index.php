<?php

include "../../crud/fin_session.php";
$_SESSION['tabla']='vueloscat_volar';
include_once "../../css/log/c/conexion.php";
$vuelos=$cons->consultas("*","vueloscat_volar","status=1","");

$tipos=$cons->consultas("*","extras_volar","status=1 and clasificacion_extra='tiposv'","");
?>
<button type="button" class="btn btn-primary" onclick="cargar_pagina('registro_cat_vuelos/form.php')">Agregar Nuevo</button>
<table class="table table-hover">
	<thead>
		<tr align="center">
			<th align="center" style="text-align: center;max-width: 15%;width: 15%">Nombre</th>
			<th align="center" style="text-align: center;max-width: 15%;width: 15%">Tipo</th>
			<th align="center" style="text-align: center;max-width: 15%;width: 15%">Precio de Niños</th>
			<th align="center" style="text-align: center;max-width: 15%;width: 15%">Precio de Adultos</th>
			<th align="center" style="text-align: center;max-width: 15%;width: 15%">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($vuelos as $vuelo) { ?>
			<tr>
				<td style="text-align: center;max-width: 15%;width: 15%"><?php echo utf8_encode( $vuelo->nombre_vc) ?></td>
				<?php $tipo=$cons->consultas("*","extras_volar","status=1 and id_extra=".$vuelo->tipo_vc,"") ?>
				<td style="text-align: center;max-width: 15%;width: 15%"><?php echo utf8_encode( $tipo[0]->nombre_extra) ?></td>
				<td style="text-align: center;max-width: 15%;width: 15%"><?php echo utf8_encode( $vuelo->precion_vc) ?></td>
				<td style="text-align: center;max-width: 15%;width: 15%"><?php echo utf8_encode( $vuelo->precioa_vc )?></td>
				<td style="text-align: center;max-width: 15%;width: 15%">
					<span class="glyphicon glyphicon-edit" title="Editar" onclick="editar_pagina(<?php echo $vuelo->id_vc ?>,1,'<?php echo utf8_encode($vuelo->nombre_vc)?>')" style="margin-right: 2px;color:#33b5e5"></span>
					<span class="glyphicon glyphicon-trash " title="Eliminar" onclick="editar_pagina(<?php echo $vuelo->id_vc ?>,0,'<?php echo utf8_encode($vuelo->nombre_vc)?>')" style="color: #ff4444"></span>
					<span class="glyphicon glyphicon-eye-open" title="Ver" onclick="editar_pagina(<?php echo $vuelo->id_vc ?>,2,'<?php echo utf8_encode($vuelo->nombre_vc)?>')" style="margin-right:2px;#0d47a1"></span>
					<span class="glyphicon glyphicon-resize-full" title="Extras"  data-toggle="modal" data-target="#modal-confirmacion" onclick="ver_Servicios(<?php echo $vuelo->id_vc ?>,'<?php  echo utf8_encode( $vuelo->nombre_vc)  ?>')" ></span>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<script type="text/javascript">
	function ver_Servicios(id,nombre){
		abrir_modal("Servicios para "+nombre,id,'servicios_vuelos.php');
	}
	function editar_pagina(id,tipo,nombre){
		if(tipo==0){
			if(confirm("Desea Eliminar "+nombre)){
				save_Data("status",0,id);
			}
		}else if(tipo==1){
			if(confirm("Desea Editar "+nombre)){
				$("#contenido").load("registro_cat_vuelos/form.php",{id:id});
			} 

		}else if(tipo==2){			
				$("#contenido").load("registro_cat_vuelos/form.php",{id:id,tipo:0});
		}
	}
	
	function save_Data(campo,value,act_temp){
		parametros={campo:campo,valor:value,id:act_temp};
		$.ajax({
			url:"registro_cat_vuelos/registro.php",
			method: "POST",
			async:false,
	  		data: parametros,
	  		success:function(response){
	  			console.log("Registro Eliminado " );
				$("#contenido").load("registro_cat_vuelos/");
	  		},
	  		error:function(){
	  			alert("Error");
	  		},
	  		statusCode: {
			    404: function() {
			      alert( "No encuontoro el archivo de registro" );
			    }
			 }
		});
	}
</script>

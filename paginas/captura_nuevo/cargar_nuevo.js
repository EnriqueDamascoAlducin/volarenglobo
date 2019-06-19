	$("input[id^='pasajeros']").attr("step",1);
	var currentDate = new Date();

	var dia = currentDate.getDate();
	var mes = currentDate.getMonth(); //Be careful! January is 0 not 1
	var year = currentDate.getFullYear();
	dia++;
	mes++;
	if(dia < 10){
		dia = "0"+dia;
	}

	if(mes < 10){
		mes = "0"+mes;
	}
	var fecha = year + "-" + (mes) + "-" + (dia);
	$("#fechavuelo").attr("min",fecha);
	$("input[id^='check']").attr("min",fecha);
	$("input[name='tdescuento']").on("click",function(){
		if($(this).val()=="1"){
			$("#cantdescuento1").attr("disabled","disabled");
			$("#cantdescuento").removeAttr("disabled");
		}else{
			$("#cantdescuento").attr("disabled","disabled");
			$("#cantdescuento1").removeAttr("disabled");

		}
		save_Data($(this).attr("name"),$(this).val());
	});
	
	$("input:not(:checkbox):not(#cantdescuento1)").on("blur",function(){
		if($(this).attr("name")=="mail"){
			if(!$(this).val().includes("@")){
				alert("No esta completo el correo");
				$(this).val("");
				return false;
			}
		}else{

			$(this).val( $(this).val().toUpperCase() );
		}
		save_Data($(this).attr("name"),$(this).val());
	});
	$("#cantdescuento").on("change",function(){
		save_Data($(this).attr("name"),$(this).val());
	});
	$("#cantdescuento1").on("blur",function(){
		save_Data($(this).attr("name"),$(this).val());
	});
	$("select:not(#cantdescuento)").on("change",function(){
		save_Data($(this).attr("name"),$(this).val());
	});
	$("textarea").on("change",function(){
		save_Data($(this).attr("name"),$(this).val());
	});
	function validate_service(check, defa){
		campo=check.id;
		id=campo.split("_");
		servicio=id[1];
		if (defa==0) {
			pasajerosa = $("#pasajerosa").val();
			pasajerosn = $("#pasajerosn").val();
			if(pasajerosa==""){
				pasajerosa=0;
			}
			if(pasajerosn==""){
				pasajerosn=0;
			}
			defa=parseInt(pasajerosa)+parseInt(pasajerosn);
		}
		if(id[0]=="precio"){
			$("#cortesia_"+id[1]).prop("checked",false);
			value=defa;
			tipo=1;
		}else{
			$("#precio_"+id[1]).prop("checked",false);
			value=defa;
			tipo=2;
		}
		if(!$("#cortesia_"+servicio).is(":checked") && !$("#precio_"+servicio).is(":checked") ){
			value=0;
		}
		//2 es de cortesia ;1 es de paga
		parametros={servicio:servicio,cantidad:value,tipo:tipo,id:act_temp};
		$.ajax({
			url:"captura_nuevo/temporal.php",
			method: "POST",
			async:false,
	  		data: parametros,
	  		success:function(response){
	  			console.log(campo+" Agregado " +response);
	  		},
	  		error:function(){
	  			alert("Error");
	  		},
	  		statusCode: {
			    404: function() {
			      alert( "No encontró el archivo de registro" );
			    }
			 }
		});
	}
	function save_Data(campo,value){
		parametros={campo:campo,valor:value,id:act_temp,tipo:tipo};
		
		$.ajax({
			url:"captura_nuevo/temporal.php",
			method: "POST",
			async:false,
	  		data: parametros,
	  		success:function(response){
	  			console.log(campo+" Agregado " +response);
	  		},
	  		error:function(){
	  			alert("Error");
	  		},
	  		statusCode: {
			    404: function() {
			      alert( "No encontró el archivo de registro" );
			    }
			 }
		});
	}

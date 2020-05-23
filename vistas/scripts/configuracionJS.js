var tabla;

//Funcion que se ejecuta al inicio
function init(){
	$("#formulario").on("submit",function(e)
	{
		guardar(e);	
	});

	getIVA();
	
}

function getIVA(){
	$.post("../ajax/GenericAjax.php?op=getIVA", function(r){
		$("#iva").val(r);
	});
}

function guardar(e){

	if(isNumeric($("#iva").val())){
		e.preventDefault();
		insertar();
	} else{
		alert('registrar un numero valido para el IVA');
	}
	
}

function insertar(){
	$("#btnGuardar").prop("disabled",true);	
	var formData = new FormData($("#formulario")[0]);
	formData.append('iva', $("#iva").val());
	$.ajax({
		url: "../ajax/GenericAjax.php?op=insertarIVA",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {            
	    	//alert(datos);
          	window.location.href = "configuracionView.php";
	    }, 
	    error: function (xhr, ajaxOptions, thrownError) {     
	        bootbox.alert(xhr.status);
	        bootbox.alert(thrownError);
      	}
	});
	$("#btnGuardar").prop("disabled",false);
}

function isNumeric(value) {
	return !isNaN(parseFloat(value)) && isFinite(value);
}

init();
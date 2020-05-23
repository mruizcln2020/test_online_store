var tabla;

//Funcion que se ejecuta al inicio
function init(){

	$("#divNuevo").hide();
	$("#divListado").show();
	$("#titulo").text("Cupones");

	$("#formulario").on("submit", function(e)
	{
		guardar(e);	
	});

	getCuponesRegistrados();
}

function getCuponesRegistrados(){
	tabla = $('#tbllistado').dataTable(
	{
		"aProcessing": true, 
		"aServerSide": true, 
		dom: 'Bfrtip', 
		buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				], 
		"ajax": {
					url: '../ajax/GenericAjax.php?op=getCupones',
					type: 'get',
					dataType: 'json',
					error: function(e){
						console.log(e.responseText);
					}
				}
	}).DataTable();
}

function mostrarDivNuevo(){

	//1-NEW 2-UPDATE
	$("#estaActualizando").val(1);

	$("#cupon").prop("disabled", false);

	$("#divListado").hide();
	$("#divNuevo").show();
	$("#titulo").text("Registrar Cupón");

	$("#cupon").val("");
	$("#descuento").val("");

	$("#aplicado").attr("checked", false);
	$("#aplicado").attr("disabled", true);
}

function mostrarDivListado(flag){
	$("#divListado").show();
	$("#divNuevo").hide();
	$("#titulo").text("Cupones");
}

function guardar(e){

	e.preventDefault();

	//1-NEW 2-UPDATE
	if($("#estaActualizando").val() == 1){
		//Se valida si el cupon no está repetico
		var cuponIn = $("#cupon").val();
		var count;
		$.post("../ajax/GenericAjax.php?op=getCuponById_CheckCuponExistente&cupon=" + cuponIn, function(r){
	        var jsonObject = JSON.parse(r);
	        count = jsonObject.iTotalRecords;
	        if(count == 1){
		    	insertar();
		    } else{
		    	alert('El cupón ya está registrado.');
		    }

	    });
	} else{
		insertar();
	}

	
    

	
}

function insertar(){

	$("#btnGuardar").prop("disabled",true);
	$("#btnCancelar").prop("disabled",true); 
	$("#btnLimpiar").prop("disabled",true);

	//0-NoAplicado 1-Aplicado
	var formData = new FormData($("#formulario")[0]);
	formData.append('cupon', $("#cupon").val());
	formData.append('tipodescuento', $("#tipodescuento").val());
	formData.append('aplicado', $("#aplicado").val());

	var urlParam = '';
	if($("#estaActualizando").val() == 2){
		//alert('va a actualizar');
		urlParam = "../ajax/GenericAjax.php?op=updateCupon";
	} else{
		//alert('va a registrar uno new');
		urlParam = "../ajax/GenericAjax.php?op=insertarCupon";
	}

	$.ajax({
		url: urlParam,
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {            
	    	alert(datos);
          	window.location.href = "cuponesView.php";
	    }, 
	    error: function (xhr, ajaxOptions, thrownError) {     
	        bootbox.alert(xhr.status);
	        bootbox.alert(thrownError);
      	}
	});

	$("#btnGuardar").prop("disabled",false);
	$("#btnCancelar").prop("disabled",false);
	$("#btnLimpiar").prop("disabled",false);

}

function actualizar(cupon){

	$("#cupon").prop( "disabled", true );

	//1-NEW 2-UPDATE
	var temp = $("#estaActualizando").val(2);
	//aleet(temp);
	//if(temp == 1){
		$.post("../ajax/GenericAjax.php?op=getCuponById&cupon=" + cupon, function(r){
	        var jsonObject = JSON.parse(r);
	        var items = jsonObject.aaData[0];
	        $("#cupon").val(items[0]);
	        $("#tipoDescuento").val(items[1]);
	        $("#descuento").val(items[2]);
	        $("#aplicado").val(items[3]);
	    });
	    $("#divNuevo").show();
		$("#divListado").hide();
		$("#titulo").text("Actualizar Cupón");
	//}
}

function eliminar(articuloId){
	var r = confirm("Está seguro de querer eliminar el cupón?");
	if (r == true) {
		$.post("../ajax/GenericAjax.php?op=deteleArticulo&articuloId=" + articuloId, function(r){
			window.location.href = "cuponesView.php";
	    });
	} 
}

init();
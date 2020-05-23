var tabla;

//Funcion que se ejecuta al inicio
function init(){

	usuarioId = $('#usuarioId').val();

	$("#divNuevo").hide();
	$("#divListado").show();
	$("#titulo").text("Articulos");

	$("#formulario").on("submit",function(e)
	{
		guardar(e);	
	});

	getArticulosRegistrados();
}

function getArticulosRegistrados(){
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
					url: '../ajax/GenericAjax.php?op=getArticulos',
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
	$("#divListado").hide();
	$("#divNuevo").show();
	$("#titulo").text("Registrar Articulo");
	$("#marca").val("");
	$("#modelo").val("");
	$("#descripcion").val("");
	$("#precio").val("");
	$("#existencia").val("");
}

function mostrarDivListado(flag){
	$("#divListado").show();
	$("#divNuevo").hide();
	$("#titulo").text("Articulos");
}

function guardar(e){
	e.preventDefault();
	insertar();
}

function insertar(){

	$("#btnGuardar").prop("disabled",true);
	$("#btnCancelar").prop("disabled",true); 
	$("#btnLimpiar").prop("disabled",true);
	
	var formData = new FormData($("#formulario")[0]);
	formData.append('articuloId', $("#articuloId").val());
	formData.append('marca', $("#marca").val());
	formData.append('modelo', $("#modelo").val());
	formData.append('descripcion', $("#descripcion").val());
	formData.append('precio', $("#precio").val());
	formData.append('existencia', $("#existencia").val());

	var urlParam = '';
	if($("#estaActualizando").val() == 2){
		urlParam = "../ajax/GenericAjax.php?op=updateArticulo";
	} else{
		urlParam = "../ajax/GenericAjax.php?op=insertarArticulo";
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
          	window.location.href = "articulosView.php";
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

function actualizar(articuloId){
	//1-NEW 2-UPDATE
	$("#estaActualizando").val(2);
	$.post("../ajax/GenericAjax.php?op=getArticuloById&articuloId=" + articuloId, function(r){
        var jsonObject = JSON.parse(r);
        var items = jsonObject.aaData[0];
        $("#articuloId").val(items[0]);
        $("#marca").val(items[1]);
        $("#modelo").val(items[2]);
        $("#descripcion").val(items[3]);
        $("#precio").val(items[4]);
        $("#existencia").val(items[5]);
    });
    $("#divNuevo").show();
	$("#divListado").hide();
	$("#titulo").text("Actualizar Articulo");
}

function eliminar(articuloId){
	var r = confirm("Está seguro de querer eliminar el articulo?");
	if (r == true) {
		$.post("../ajax/GenericAjax.php?op=deteleArticulo&articuloId=" + articuloId, function(r){
			window.location.href = "articulosView.php";
	    });
	} 
}

init();
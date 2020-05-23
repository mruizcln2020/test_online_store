var tabla;
var clienteId = 0;

//Funcion que se ejecuta al inicio
function init(){

	usuarioId = $('#usuarioId').val();

	mostrarDivListado(true);

	$("#formulario").on("submit",function(e)
	{
		guardar(e);	
	});

	getClientesRegistrados();
	
}

function getClientesRegistrados(){
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
					url: '../ajax/GenericAjax.php?op=getClientes',
					type: 'get',
					dataType: 'json',
					error: function(e){
						console.log(e.responseText);
					}
				}
	}).DataTable();
}

function mostrarDivListado(flag){
	if(flag)
	{
		mostrarDivNuevo(false);
		mostrarDivEditar(false);
		$("#divListado").show();
		$("#titulo").text("Clientes");
	} 
	else{
		$("#divListado").hide();
	}
}

function mostrarDivNuevo(flag){
	if (flag)
	{
		//1-NEW 2-UPDATE
		$("#estaActualizando").val(1);

		mostrarDivListado(false);
		mostrarDivEditar(false);
		$("#divNuevo").show();
		$("#titulo").text("Registrar Nuevo Cliente");
	}
	else
	{
		$("#divNuevo").hide();
	}
}

function mostrarDivEditar(flag){
	if (flag)
	{
		mostrarDivListado(false);
		mostrarDivNuevo(false);
		$("#divEditar").show();
		$("#titulo").text("Actualizar Datos del Cliente");
	}
	else
	{
		$("#divEditar").hide();
	}
}

function guardar(e){
	e.preventDefault();
	//1-NEW 2-UPDATE
	insertar();
}

function insertar(){

	$("#btnGuardar").prop("disabled",true);
	$("#btnCancelar").prop("disabled",true); 
	$("#btnLimpiar").prop("disabled",true);
	
	var formData = new FormData($("#formulario")[0]);
	formData.append('clienteId', clienteId);
	formData.append('nombre', $("#nombre").val());
	formData.append('apellidoPaterno', $("#apellidoPaterno").val());
	formData.append('apellidoMaterno', $("#apellidoMaterno").val());
	formData.append('rfc', $("#rfc").val());

	//1-NEW 2-UPDATE
	var urlParam = '';
	if($("#estaActualizando").val() == 2){
		urlParam = "../ajax/GenericAjax.php?op=updateCliente";
	} else{
		urlParam = "../ajax/GenericAjax.php?op=insertarCliente";
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
          	window.location.href = "clientesView.php";
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

function actualizar(cteId){
	clienteId = cteId;
	//1-NEW 2-UPDATE
	$.post("../ajax/GenericAjax.php?op=getClienteById&clienteId=" + clienteId, function(r){
		//1-NEW 2-UPDATE
		$("#estaActualizando").val(2);
        var jsonObject = JSON.parse(r);
        var items = jsonObject.aaData[0];
        $("#nombre").val(items[0]);
        $("#apellidoPaterno").val(items[1]);
        $("#apellidoMaterno").val(items[2]);
        $("#rfc").val(items[3]);
    });
    $("#divNuevo").show();
	$("#divListado").hide();
	$("#titulo").text("Actualizar Cliente");
}

function eliminar(clienteId){
	var r = confirm("Está seguro de querer eliminar el cliente?");
	if (r == true) {
		$.post("../ajax/GenericAjax.php?op=deleteCliente&clienteId=" + clienteId, function(r){
			window.location.href = "clientesView.php";
	    });
	} 
}

init();
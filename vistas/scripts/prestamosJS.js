var tabla;
var tablaAmortizaciones;
var usuarioId = 0;

//Funcion que se ejecuta al inicio
function init(){

	usuarioId = $('#usuarioId').val();

	mostrarDivListado(true);
	getPrestamosRegistrados();

	$("#formulario").on("submit",function(e)
	{
		guardar(e);	
	});

	$("#formularioEditar").on("submit",function(e)
	{
		guardarEditar(e);	
	});

	cargarComboClientes();
	cargarComboMontos();
	cargarComboPlazos();
	cargarComboInteres();
}

function getPrestamosRegistrados(){
	tabla = $('#tbllistado').dataTable(
	{
		"aProcessing": true, //Activacion del procesamiento del datatable
		"aServerSide": true, //Paginacion y filtrados realizador por el server
		dom: 'Bfrtip', //Los elemenentos de la tabla
		buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				], 
		"ajax": {
					url: '../ajax/GenericAjax.php?op=getPrestamos',
					type: 'get',
					dataType: 'json',
					error: function(e){
						console.log(e.responseText);
					}
				}
	}).DataTable();
}

function cargarComboClientes(){
	$.post("../ajax/GenericAjax.php?op=getClientesCombo", function(r){
        $("#cliente").html(r);
        $('#cliente option[value="0"]').attr("selected",true);
        $('#cliente').selectpicker('refresh');
	});
}

function cargarComboMontos(){
	$.post("../ajax/GenericAjax.php?op=getMontosCombo", function(r){
        $("#monto").html(r);
        $('#monto option[value="0"]').attr("selected",true);
        $('#monto').selectpicker('refresh');
	});
}

function cargarComboPlazos(){
	$.post("../ajax/GenericAjax.php?op=getPlazosCombo", function(r){
        $("#plazo").html(r);
        $('#plazo option[value="0"]').attr("selected",true);
        $('#plazo').selectpicker('refresh');
	});
}

function cargarComboInteres(){
	$.post("../ajax/GenericAjax.php?op=getInteresesCombo", function(r){
        $("#interes").html(r);
        $('#interes option[value="0"]').attr("selected",true);
        $('#interes').selectpicker('refresh');
	});
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
	formData.append('clienteId', $("#cliente").val());
	formData.append('montoId', $("#monto").val());
	formData.append('plazoId', $("#plazo").val());
	formData.append('interesId', $("#interes").val());

	alert(formData);

	$.ajax({
		url: "../ajax/GenericAjax.php?op=insertarPrestamo",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {           
	    	alert(datos);  
          	//bootbox.alert(datos);
          	mostrarDivAmortizacion(false);
          	window.location.href = "prestamosView.php";
	    }, 
	    error: function (xhr, ajaxOptions, thrownError) {     
	    	alert('fail');
	        //bootbox.alert(xhr.status);
	        //bootbox.alert(thrownError);
      	}
	});

	$("#btnGuardar").prop("disabled",false);
	$("#btnCancelar").prop("disabled",false);
	$("#btnLimpiar").prop("disabled",false);
}

function openAmortizaciones(prestamoId){

	mostrarDivAmortizacion(true);

	tablaAmortizaciones = $('#tbllistadoAmortizaciones').dataTable(
	{
		"aProcessing": true, //Activacion del procesamiento del datatable
		"aServerSide": true, //Paginacion y filtrados realizador por el server
		dom: 'Bfrtip', //Los elemenentos de la tabla
		buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				], 
		"ajax": {
					url: '../ajax/GenericAjax.php?op=getTablaAmortizacion&prestamoId=' + prestamoId,

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
		mostrarDivAmortizacion(false);
		$("#divListado").show();
		$("#titulo").text("Prestamos");
	} 
	else{
		$("#divListado").hide();
	}
}

function mostrarDivNuevo(flag){
	if (flag)
	{
		mostrarDivListado(false);
		mostrarDivAmortizacion(false);
		$("#divNuevo").show();
		$("#titulo").text("Registrar Prestamo");
	}
	else
	{
		$("#divNuevo").hide();
	}
}

function mostrarDivAmortizacion(flag){
	if (flag)
	{
		mostrarDivListado(false);
		mostrarDivNuevo(false);
		$("#divAmortizaciones").show();
		$("#titulo").text("Tabla de Amortización");
	}
	else
	{
		$("#divAmortizaciones").hide();
	}
}

function eliminar(prestamoId){
	if(prestamoId > 0){
		$.post("../ajax/GenericAjax.php?op=deletePrestamo&prestamoId=" + prestamoId, function(r){
			alert(r);
    		bootbox.alert(r);
    		window.location.href = "prestamosView.php";
    	});
	} else{
		bootbox.alert('Ocurrió un error al intentar eliminar el prestamo');
	}
}


init();
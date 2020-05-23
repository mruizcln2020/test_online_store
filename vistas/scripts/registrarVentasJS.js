var tabla;

var clienteId = 0;
var articuloId = 0;
var cantidadIngresada = 0;
var precioUnitario = 0;
var precioTotal = 0;
var subtotal = 0;
var iva = 0;
var total = 0;
var descuento = 0;
var cantArticulosVenta = 0;
var cantInventarioArticulo = 0;
var cupon;

function init(){
	$("#divNuevo").show();
	$("#divCupon").hide();
	$("#divBotones2").hide();	
	$("#articulo").change(function() {
	    actualizarInfoArticulo();
	});
	$("#cliente").change(function() {
	    clienteId =  $('#cliente').val();
	    sessionStorage.setItem("clienteId",clienteId);
	});
	getArticulosVenta();
	cargarComboClientes();
	cargarComboArticulos();

	clienteId = sessionStorage.getItem('clienteId');
	if(clienteId != null){
		$('#cliente option[value="2"]').attr("selected",true);
	} 
	
}

function actualizarInfoArticulo(){
	articuloId =  $('#articulo').val();
	$.post("../ajax/GenericAjax.php?op=getArticuloById&articuloId=" + articuloId, function(r){
        var jsonObject = JSON.parse(r);
        var items = jsonObject.aaData[0];
        $("#marcaHidden").val(items[1]);
        $("#modeloHidden").val(items[2]);
        $("#descripcionHidden").val(items[3]);
        $("#precioHidden").val(items[4]);
        $("#existenciaHidden").val(items[5]);
    });
}

function getArticulosVenta(){
	//alert('getArticulosVenta');
	tabla = $('#tbllistado').dataTable(
	{
		"ajax": {
					url: '../ajax/GenericAjax.php?op=getArticulosVenta',
					type: 'get',
					dataType: 'json',
					error: function(e){
						console.log(e.responseText);
					}
				}
	}).DataTable();

	$.post("../ajax/GenericAjax.php?op=getMontoTotal", function(r){
        if(r > 0){
        	subtotal = r;
        	$("#importeInfo").text(r);
        	$("#descInfo").text(0);
        	$.post("../ajax/GenericAjax.php?op=getIVA", function(r){
		        if(r > 0){
		        	iva = subtotal * r / 100;
		        	total = (subtotal + iva);
		        	total = Number(subtotal) + Number(iva);

					$("#ivaInfo").text(iva);
					$("#totalInfo").text(total);
		        } else{
		        	$("#importeInfo").text(0);
		        	$("#ivaInfo").text(0);
		        	$("#descInfo").text(0);
		        	$("#totalInfo").text(0);
		        }
		    });


        } else{
        	$("#importeInfo").text(0);
        	$("#ivaInfo").text(0);
        	$("#descInfo").text(0);
        	$("#totalInfo").text(0);
        }
    });
}

function cargarComboClientes(){
	$.post("../ajax/GenericAjax.php?op=getClientesCombo", function(r){
        $("#cliente").html(r);
        $('#cliente option[value="0"]').attr("selected",true);
        $('#cliente').selectpicker('refresh');
	});
}

function cargarComboArticulos(){
	$.post("../ajax/GenericAjax.php?op=getArticulosCombo", function(r){
        $("#articulo").html(r);
        $('#articulo option[value="0"]').attr("selected",true);
        $('#articulo').selectpicker('refresh');
        actualizarInfoArticulo();
	});
}

function guardarArticulo(){

	//Se valida la cantidad ingresada
	cantidadIngresada = $("#cantidad").val();
	if(cantidadIngresada == ''){
		alert('Favor de agregar la cantidad de articulos');
	} else{
		if(!isNumeric(cantidadIngresada)){
			alert('Favor de ingresar una cantidad valida');
		} else{
			//Se valida la disponibilidad
			$.post("../ajax/GenericAjax.php?op=getDisponibilidadArticulo&articuloId=" + articuloId, function(r){
				//alert('cantidadIngresada ' + cantidadIngresada);
				//alert('r ' + r);
				if(Number(cantidadIngresada) > Number(r)){
					alert('El artículo seleccionado no cuenta con existencia, favor de verificar.');
				} else{
					$.post("../ajax/GenericAjax.php?op=getArticulosVentaById_SP&articuloId=" + articuloId, function(r){
						if(r == 'null'){
							precioUnitario = $("#precioHidden").val();
							precioTotal = precioUnitario * cantidadIngresada;
							$.post("../ajax/GenericAjax.php?op=getIVA", function(r){
								iva = r;
								insertar();
			    			}); 
							
						} else{
							alert('El articulo ya está en la lista de articulos de la venta');
						}
	    			});  
				}
		    });
		}
	}
}

function insertar(){

	$("#btnGuardar").prop("disabled",true);
	$("#btnCancelar").prop("disabled",true); 
	$("#btnLimpiar").prop("disabled",true);

	var formData = new FormData($("#formulario")[0]);
	formData.append('cantidad', cantidadIngresada);
	formData.append('pu', precioUnitario);
	formData.append('pt', precioTotal);
	formData.append('articuloId', articuloId);

	$.ajax({
		url: "../ajax/GenericAjax.php?op=insertarArticuloTemp",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {           
	    	//alert('insertar: ' + datos);  
	    	window.location.href = "registrarVentaView.php";
	    }, 
	    error: function (xhr, ajaxOptions, thrownError) {     
	    	alert('fail');
      	}
	});

	$("#btnGuardar").prop("disabled",false);
	$("#btnCancelar").prop("disabled",false);
	$("#btnLimpiar").prop("disabled",false);
}

function aplicarCupon(){
	cupon = $("#cupon").val();
	if(cupon == ''){
		alert('Captura el cupón');
	} else{
		$.post("../ajax/GenericAjax.php?op=getCuponById&cupon=" + cupon, function(r){
			//alert(r);
			var jsonObject = JSON.parse(r);
			if(jsonObject.iTotalRecords > 0){
				var items = jsonObject.aaData[0];
				var tipoDesc = items[1];
				var desc = items[2];
		        var aplicado = items[3];
		        //0-NoAplicado 1-Aplicado
		        if(aplicado == 1){
		        	alert('El cupón ya ha sido cajeado por otro cliente, favor de verificar');
		        } else{
		        	if(tipoDesc == 'Cantidad'){
		        		total = Number(subtotal) + Number(iva) - desc;
		        		$("#descInfo").text(desc);
		        		$("#totalInfo").text(total);  
		        		descuento = desc;     		
			        } else{
			        	var subtotalConIVA = Number(subtotal) + Number(iva);
			        	var descPorc = subtotalConIVA * desc / 100;
			        	total = Number(subtotal) + Number(iva) - descPorc;
			        	$("#descInfo").text(descPorc);
		        		$("#totalInfo").text(total);     
		        		descuento = descPorc; 
			        }
		        }
			} else{	
				alert('No se encontró el cupón');
			}
		});  
	}
}

function updateArticuloVenta(){
	$.post("../ajax/GenericAjax.php?op=updateArticuloVenta&temporalId=" + temporalId + "&cantidad=" + cantidad + "&precioTotal=" + precioTotal, function(r){
        $("#nombreDiv").text(r);
    });
}

function siguiente() {
	if(total > 0){
		$("#divCupon").show();
		$("#divBotones2").show();
		$("#divNuevo").hide();
		$("#divBotones1").hide();
	}else{
		alert('No tienes articulos agregados');
	}
}

function regresar() {
	$("#divCupon").hide();
	$("#divBotones2").hide();
	$("#divNuevo").show();
	$("#divBotones1").show();	
}

function finalizar(){
	if(cupon = 'undefined'){
		cupon = '';
	}
	if(clienteId <= 0){
		alert('Selecciona el cliente');
	} else{
		var formData = new FormData($("#formulario")[0]);
		formData.append('clienteId', clienteId);
		formData.append('importe', subtotal);
		formData.append('iva', iva);
		formData.append('descuento', descuento);
		formData.append('total', total);
		formData.append('cupon', cupon);
		$.ajax({
			url: "../ajax/GenericAjax.php?op=insertarVenta",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,
		    success: function(datos)
		    {   
		    	alert(datos);
		    	window.location.href = "ventasView.php"; 
		    	/*/
		    	$.post("../ajax/GenericAjax.php?op=updateInventario", function(r){
		        	//alert(r);
		        	alert("Bien Hecho, Tu venta ha sido registrada correctamente");
		    		window.location.href = "ventasView.php";      
	          	});
	          	*/
		    }, 
		    error: function (xhr, ajaxOptions, thrownError) {     
		    	alert('fail');
	      	}
		});
	}
}

function redirigirListadoVentas() {
	sessionStorage.setItem("clienteId",0);
	window.location.href = "ventasView.php";
}

function isNumeric(value) {
	return !isNaN(parseFloat(value)) && isFinite(value);
}

init();
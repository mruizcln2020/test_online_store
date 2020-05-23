<?php 

session_start();
require_once "../modelos/GenericModel.php";
//require_once "../entities/ArticuloVentaEntity.php";

date_default_timezone_set('America/Mazatlan');

//Instancia el objeto a procesar con la BD y obtiene la info de la vista mediante POST
$genericModel = new GenericModel();

$clienteId = isset($_POST["clienteId"])? limpiarCadena($_POST["clienteId"]):"";
$montoId = isset($_POST["montoId"])? limpiarCadena($_POST["montoId"]):"";
$plazoId = isset($_POST["plazoId"])? limpiarCadena($_POST["plazoId"]):"";
$interesId = isset($_POST["interesId"])? limpiarCadena($_POST["interesId"]):"";

$articuloId = isset($_POST["articuloId"])? limpiarCadena($_POST["articuloId"]):"";
$marca = isset($_POST["marca"])? limpiarCadena($_POST["marca"]):"";
$modelo = isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$descripcion = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$precio = isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$existencia = isset($_POST["existencia"])? limpiarCadena($_POST["existencia"]):"";

$cupon = isset($_POST["cupon"])? limpiarCadena($_POST["cupon"]):"";
$tipoDescuento = isset($_POST["tipodescuento"])? limpiarCadena($_POST["tipodescuento"]):"";
$descuento = isset($_POST["descuento"])? limpiarCadena($_POST["descuento"]):"";
$aplicado = isset($_POST["aplicado"])? limpiarCadena($_POST["aplicado"]):"";

$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$pu = isset($_POST["pu"])? limpiarCadena($_POST["pu"]):"";
$pt = isset($_POST["pt"])? limpiarCadena($_POST["pt"]):"";

$importe = isset($_POST["importe"])? limpiarCadena($_POST["importe"]):"";
$iva = isset($_POST["iva"])? limpiarCadena($_POST["iva"]):"";
$total = isset($_POST["total"])? limpiarCadena($_POST["total"]):"";

$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidoPaterno = isset($_POST["apellidoPaterno"])? limpiarCadena($_POST["apellidoPaterno"]):"";
$apellidoMaterno = isset($_POST["apellidoMaterno"])? limpiarCadena($_POST["apellidoMaterno"]):"";
$rfc = isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";

$monto = isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$plazo = isset($_POST["plazo"])? limpiarCadena($_POST["plazo"]):"";
$interes = isset($_POST["interes"])? limpiarCadena($_POST["interes"]):"";

switch ($_GET['op']) {



	/* RETRIEVE */
	case 'getVentas':
    	$result = '';
    	$datos = [];
		$resp = $genericModel -> getVentas();
		while ($reg = $resp -> fetch_object()) {
			$datos[] = array(
				"0" => '',
				"1" => $reg->folio,
				"2" => date("d/m/Y", strtotime($reg->fecha)),
				"3" => $reg->clienteId,
				"4" => $reg->cliente,
				"5" => $reg->importe,
				"6" => $reg->iva,
				"7" => $reg->descuento,
				"8" => $reg->total
			);
		}
		$results = array(
			"sEcho" => 1, //Info para el datatable
			"iTotalRecords" => count($datos), //total de registros del dt
			"iTotalDisplayrecords" => count($datos), //total reg a mostrar
			"aaData" => $datos
		);
		$result = json_encode($results);
		echo $result;
    break;
    case 'getArticulos':
    	$result = '';
    	$datos = [];
		$resp = $genericModel -> getArticulos();
		while ($reg = $resp -> fetch_object()) {
			$datos[] = array(
				"0" => '<button class="btn btn-secondary" title="Actualizar Venta" onclick="actualizar('.$reg->articuloId.')"><i class="fa fa-refresh"></i> <button class="btn btn-secondary" title="Eliminar Articulo" onclick="eliminar('.$reg->articuloId.')"><i class="fa fa-trash"></i></button>',
				"1" => $reg->articuloId,
				"2" => $reg->marca,
				"3" => $reg->modelo,
				"4" => $reg->descripcion,
				"5" => $reg->precio,
				"6" => $reg->existencia
			);
		}
		$results = array(
			"sEcho" => 1, //Info para el datatable
			"iTotalRecords" => count($datos), //total de registros del dt
			"iTotalDisplayrecords" => count($datos), //total reg a mostrar
			"aaData" => $datos
		);
		$result = json_encode($results);
		echo $result;
    break;
    case 'getArticuloById':
    	$result = 0;
    	$articuloId = $_GET['articuloId'];
		if($articuloId == ''){
			echo 'Falta el id del articulo';
		} 
		else{
			$resp = $genericModel -> getArticuloById($articuloId);
			while ($reg = $resp -> fetch_object()) {
				$datos[] = array(
					"0" => $reg->articuloId,
					"1" => $reg->marca,
					"2" => $reg->modelo,
					"3" => $reg->descripcion,
					"4" => $reg->precio,
					"5" => $reg->existencia
				);
			}
			$results = array(
				"sEcho" => 1, //Info para el datatable
				"iTotalRecords" => count($datos), //total de registros del dt
				"iTotalDisplayrecords" => count($datos), //total reg a mostrar
				"aaData" => $datos
			);
			$result = json_encode($results);
		}
		echo $result;
    break;
    case 'getClientes':
    	$result = '';
    	$datos = [];
		$resp = $genericModel -> getClientes();
		while ($reg = $resp -> fetch_object()) {
			$datos[] = array(
				"0" => '<button class="btn btn-secondary" title="Actualizar" onclick="actualizar('.$reg->clienteId.')"><i class="fa fa-refresh"></i></button> <button class="btn btn-secondary" title="Eliminar" onclick="eliminar('.$reg->clienteId.')"><i class="fa fa-trash"></i></button>',
				"1" => $reg->clienteId,
				"2" => $reg->nombre,
				"3" => $reg->apellidoPaterno,
				"4" => $reg->apellidoMaterno,
				"5" => $reg->rfc
			);
		}
		$results = array(
			"sEcho" => 1, //Info para el datatable
			"iTotalRecords" => count($datos), //total de registros del dt
			"iTotalDisplayrecords" => count($datos), //total reg a mostrar
			"aaData" => $datos
		);
		$result = json_encode($results);
		echo $result;
    break;
    case 'getClientesCombo':
    	$resp = $genericModel->getClientes();
    	//echo '<option value=0>Selecciona un cliente</option>';
		while ($reg = $resp->fetch_object())
		{
			echo '<option value=' . $reg->clienteId . '>' . $reg->apellidoPaterno . ' ' . $reg->apellidoMaterno . ' ' . $reg->nombre . '</option>';
		}
	break;
    case 'getClienteById':
    	$result = 0;
    	$datos = [];
    	$clienteId = $_GET['clienteId'];
		if($clienteId == ''){
			echo 'Falta el clienteId';
		} 
		else{
			$resp = $genericModel -> getClienteById($clienteId);
			while ($reg = $resp -> fetch_object()) {
				$datos[] = array(
					"0" => $reg->nombre,
					"1" => $reg->apellidoPaterno,
					"2" => $reg->apellidoMaterno,
					"3" => $reg->rfc
				);
			}
			$results = array(
				"sEcho" => 1, 
				"iTotalRecords" => count($datos), 
				"iTotalDisplayrecords" => count($datos),
				"aaData" => $datos
			);
			$result = json_encode($results);
		}
		echo $result;
	break;
    case 'getCupones':
    	$result = '';
    	$datos = [];
		$resp = $genericModel -> getCupones();
		while ($reg = $resp -> fetch_object()) {
			$datos[] = array(
				"0" => '<button class="btn btn-secondary" title="Actualizar Cupón" onclick="actualizar(\''.$reg->cupon.'\')"><i class="fa fa-refresh"></i> <button class="btn btn-secondary" title="Eliminar Cupón" onclick="eliminar('.$reg->cupon.')"><i class="fa fa-trash"></i></button>',
				"1" => $reg->cupon,
				"2" => $reg->tipoDescuento,
				"3" => $reg->descuento,
				"4" => $reg->aplicadoTexto
			);
		}
		$results = array(
			"sEcho" => 1, //Info para el datatable
			"iTotalRecords" => count($datos), //total de registros del dt
			"iTotalDisplayrecords" => count($datos), //total reg a mostrar
			"aaData" => $datos
		);
		$result = json_encode($results);
		echo $result;
    break;
    case 'getCuponById_CheckCuponExistente':
    	$result = 0;
    	$datos[] = array();
    	$cupon = $_GET['cupon'];
		if($cupon == ''){
			echo 'Falta el cupon';
		} 
		else{
			$resp = $genericModel -> getCuponById($cupon);
			while ($reg = $resp -> fetch_object()) {
				$datos[] = array(
					"0" => $reg->cupon,
					"1" => $reg->tipoDescuento,
					"2" => $reg->descuento,
					"3" => $reg->aplicado
				);
			}
			$results = array(
				"sEcho" => 1, 
				"iTotalRecords" => count($datos), 
				"iTotalDisplayrecords" => count($datos),
				"aaData" => $datos
			);
			$result = json_encode($results);
		}
		echo $result;
	break;
    case 'getCuponById':
    	$result = 0;
    	$datos = [];
    	$cupon = $_GET['cupon'];
		if($cupon == ''){
			echo 'Falta el cupon';
		} 
		else{
			$resp = $genericModel -> getCuponById($cupon);
			while ($reg = $resp -> fetch_object()) {
				$datos[] = array(
					"0" => $reg->cupon,
					"1" => $reg->tipoDescuento,
					"2" => $reg->descuento,
					"3" => $reg->aplicado
				);
			}
			$results = array(
				"sEcho" => 1, 
				"iTotalRecords" => count($datos), 
				"iTotalDisplayrecords" => count($datos),
				"aaData" => $datos
			);
			$result = json_encode($results);
		}
		echo $result;
	break;
	case 'getArticulosCombo':
    	$resp = $genericModel->getArticulos();
		while ($reg = $resp->fetch_object())
		{
			echo '<option value=' . $reg->articuloId . '>' . $reg->marca . ' ' . $reg->modelo . ' ' . $reg->descripcion . '</option>';
		}
	break;
	case 'getArticulosVenta':
    	$result = '';
    	$datos = [];
		$resp = $genericModel -> getArticulosVentaTemp();
		while ($reg = $resp -> fetch_object()) {
			$datos[] = array(
				"0" => '<button class="btn btn-secondary" title="Eliminar" onclick="eliminar('.$reg->temporalId.')"><i class="fa fa-trash"></i></button>',
				"1" => $reg->articuloId,
				"2" => $reg->marca,
				"3" => $reg->descripcion,
				"4" => $reg->cantidad,
				"5" => $reg->pu,
				"6" => $reg->pt
			);
		}
		$results = array(
			"sEcho" => 1, //Info para el datatable
			"iTotalRecords" => count($datos), //total de registros del dt
			"iTotalDisplayrecords" => count($datos), //total reg a mostrar
			"aaData" => $datos
		);
		$result = json_encode($results);
		echo $result;
    break;
    case 'getArticulosVentaById_SP':
    	$result = 0;
    	$articuloId = $_GET['articuloId'];
		if($articuloId == ''){
			echo 'Falta el articuloId';
		} 
		else{
			$datos[] = null;
			$resp = $genericModel -> getArticulosVentaById($articuloId);
			$temp = $resp-> fetch_object();
			if($temp == null){
				$result = 'null';
			} else{
				while ($reg = $resp -> fetch_object()) {
					$datos[] = array(
						"0" => $reg->temporalId,
						"1" => $reg->articuloId,
						"2" => $reg->cantidad,
						"3" => $reg->pu,
						"4" => $reg->pt
					);
				}
				$results = array(
					"sEcho" => 1, //Info para el datatable
					"iTotalRecords" => count($datos), //total de registros del dt
					"iTotalDisplayrecords" => count($datos), //total reg a mostrar
					"aaData" => $datos
				);
				$result = json_encode($results);
			}
		}
		echo $result;
	break;
    case 'getMontoTotal':
    	$result = 0;
		$resp = $genericModel -> getMontoTotal();
		$rowcount = mysqli_num_rows($resp);
		if($rowcount > 0){
			$suma = 0;
			while ($reg = $resp->fetch_object())
			{
				$result = $reg->suma;
			}
		} 
		echo $result;
	break;
	case 'getDisponibilidadArticulo':
		$articuloId = $_GET['articuloId'];
		if($articuloId == ''){
			echo 'Falta el id del articulo';
		} 
		else{
			$resp = $genericModel -> getArticuloById($articuloId);
			$rowcount = mysqli_num_rows($resp);
			if($rowcount > 0){
				while ($reg = $resp->fetch_object())
				{
					echo $reg->existencia;			
				}
			} 
			else{
				echo 'No se encontró el articulo';
			}
		}
	break;
	case 'getIVA':
		$resp = $genericModel -> getIVA();
		$rowcount = mysqli_num_rows($resp);
		if($rowcount > 0){
			while ($reg = $resp->fetch_object())
			{
				echo $reg->iva;			
			}
		} 
		else{
			echo '0';
		}
	break;
	case 'getCantArticulosVenta':
		$resp = $genericModel -> getCantArticulosVenta();
		$rowcount = mysqli_num_rows($resp);
		if($rowcount > 0){
			while ($reg = $resp->fetch_object())
			{
				echo $reg->cant;			
			}
		} 
		else{
			echo '0';
		}
	break;
	case 'getInventarioArticulo':
		$resp = $genericModel -> getInventarioArticulo();
		$rowcount = mysqli_num_rows($resp);
		if($rowcount > 0){
			while ($reg = $resp->fetch_object())
			{
				echo $reg->cantInventario;			
			}
		} 
		else{
			echo '0';
		}
	break;


    /* INSERTS */
	case 'insertarArticulo':
		$resp = $genericModel -> insertarArticulo($marca, $modelo, $descripcion, $precio, $existencia);
		echo $resp ? "Articulo Registrado" : "Articulo No Registrado";
	break;
    case 'insertarCliente':
		$resp = $genericModel -> insertarCliente($nombre, $apellidoPaterno, $apellidoMaterno, $rfc);
		echo $resp ? "Cliente Registrado" : "Cliente No Registrado";
	break;
	case 'insertarCupon':
		$resp = $genericModel -> insertarCupon($cupon, $tipoDescuento, $descuento, $aplicado);
		echo $resp ? "Cupón Registrado" : "Cupón No Registrado";
	break;
	case 'insertarArticuloTemp':
		$resp = $genericModel -> insertarArticuloTemp($cantidad, $pu, $pt, $articuloId);
		//echo $resp ? "Articulo Registrado" : "Articulo No Registrado";
	break;
	case 'insertarIVA':
		$resp = $genericModel -> insertarIVA($iva);
		echo $resp ? "IVA Registrado" : "IVA No Registrado";
	break;
	case 'insertarVenta':
		$fecha = date("Y") . "-" . date("m") . "-" . date("d");
		$resp = $genericModel -> insertarVenta($fecha, $clienteId, $importe, $iva, $descuento, $total, $cupon);
		/*
		$resp2 = $genericModel -> getArticulosVentaTemp();
		echo "bla bla bla bla";
		while ($reg = $resp2 -> fetch_object()) {
			echo 'entro1';
			$cantVenta = $reg->cantidad;
			$resp3 = $genericModel -> getArticuloById($reg->articuloId);
			while ($reg2 = $resp3 -> fetch_object()) {
				echo 'entro2';
				$cantExistencia = $reg2->existencia;
				$cantActualizada = $cantExistencia - $cantVenta;
				$resp4 = $genericModel -> updateInventario($reg2->articuloId, $cantActualizada);
			}
		}
		*/
		echo $resp ? "Bien Hecho, Tu venta ha sido registrada correctamente" : "Venta No Registrada";
	break;
	case 'actualizarInventario':
		$resp = $genericModel -> insertarArticulo($marca, $modelo, $descripcion, $precio, $existencia);
		echo $resp ? "Articulo Registrado" : "Articulo No Registrado";
	break;

	/* UPDATES */ 
	case 'updateArticulo':
		$resp = $genericModel -> updateArticulo($articuloId, $marca, $modelo, $descripcion, $precio, $existencia);
		echo $resp ? "Articulo Actualizado" : "Articulo No Actualizado";
	break;
	case 'updateCupon':
		$resp = $genericModel -> updateCupon($cupon, $tipoDescuento, $descuento, $aplicado);
		echo $resp ? "Cupón Actualizado" : "Cupón No Actualizado";
	break;
	case 'updateArticuloVenta':
		$temporalId = $_GET['temporalId'];
		$cantidad = $_GET['cantidad'];
		$precioTotal = $_GET['precioTotal'];
		$resp = $genericModel -> updateArticuloVenta($cantidad, $precioTotal, $temporalId);
		echo $resp ? "Articulo Actualizado" : "Articulo No Actualizado";
	break;
	case 'updateCliente':
		$resp = $genericModel -> updateCliente($clienteId, $nombre, $apellidoPaterno, $apellidoMaterno, $rfc);
		echo $resp ? "Cliente Registrado" : "Cliente No Registrado";
	break;
	case 'updateInventario':
    	$result = '';
    	$datos = [];
		$resp = $genericModel -> getArticulosVentaTemp();
		while ($reg = $resp -> fetch_object()) {
			$cantVenta = $reg->cantidad;
			$artId = $reg->articuloId;
			echo 'cantVenta = ' . $cantVenta;
			echo ' artId = ' . $artId;
			$resp2 = $genericModel -> getArticuloById($artId);
			echo 'resp2 = ' . $resp2;	

			/*
			$rowcount = mysqli_num_rows($resp2);
			echo 'rowcount = ' . $rowcount;	
			if($rowcount > 0){
				while ($reg2 = $resp2->fetch_object())
				{
					$cantExistencia = $reg2->existencia;
					$cantActualizada = $cantExistencia - $cantVenta;	
					echo 'cantActualizada = ' . $cantActualizada;		
				}
			} 

			/*
			while ($reg = $resp2 -> fetch_object()) {
				$cantExistencia = $reg->existencia;
				$cantActualizada = $cantExistencia - $cantVenta;
				echo 'cantActualizada = ' . $cantActualizada;
				$resp3 = $genericModel -> updateInventario($reg->articuloId, $cantActualizada);
				$result = 'resp3 = ' . $resp3;
			}
			*/
		}
		echo $result;
    break;



	/* DELETES */
	case 'deteleArticulo':
		$result = 0;
    	$articuloId = $_GET['articuloId'];
		if($articuloId == ''){
			echo 'Falta el id del articulo';
		} 
		else{
			$resp = $genericModel -> deteleArticulo($articuloId);
			echo $resp ? "Articulo Eliminado" : "Articulo No Eliminado";
		}
	break;
	case 'deteleArticulosVenta':
		$resp = $genericModel -> deteleArticulosVenta();
		echo $resp ? "Articulos Eliminados" : "Articulos No Eliminados";
	break;
	case 'deleteCliente':
		$result = 0;
    	$clienteId = $_GET['clienteId'];
		if($clienteId == ''){
			echo 'Falta el id del articulo';
		} 
		else{
			$resp = $genericModel -> deleteCliente($clienteId);
			echo $resp ? "Cliente Eliminado" : "Cliente No Eliminado";
		}
	break;
}
?>
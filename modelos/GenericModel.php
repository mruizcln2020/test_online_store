<?php 

//Inclu铆mos inicialmente la conexi贸n a la base de datos
require "../config/Conexion.php";

Class GenericModel
{
	public function __construct()
	{

	}

	/* LOGIN */
	public function checkLogin($usuario, $password){
		$sql = "CALL checkLogin('$usuario', '$password')";
		return ejecutarConsulta($sql);		
	}

	/* RETRIEVE */
	public function getArticulos(){
		$sql = "CALL getArticulos()";
		return ejecutarConsulta($sql);		
	}
	public function getArticuloById($articuloId){
		$sql = "CALL getArticulosById($articuloId)";
		//print_r($sql);
		return ejecutarConsulta($sql);		
	}
	public function getClientes(){
		$sql = "CALL getClientes()";
		return ejecutarConsulta($sql);
	}
	public function getClienteById($clienteId){
		$sql = "CALL getClientesById($clienteId)";
		//print_r($sql);
		return ejecutarConsulta($sql);
	}
	public function getCupones(){
		$sql = "CALL getCupones()";
		return ejecutarConsulta($sql);
	}
	public function getCuponById($cupon){
		$sql = "CALL getCuponesById('$cupon')";
		//print_r($sql);
		return ejecutarConsulta($sql);
	}
	public function getVentas(){
		$sql = "CALL getVentas()";
		return ejecutarConsulta($sql);
	}
	public function getDetalleVentas($folio){
		$sql = "CALL getDetalleVentas($folio)";
		return ejecutarConsulta($sql);
	}
	public function getArticulosVentaTemp(){
		$sql = "CALL getArticulosVenta()";
		return ejecutarConsulta($sql);		
	}
	public function getArticulosVentaById($articuloId){
		$sql = "CALL getArticulosVentaById($articuloId)";
		return ejecutarConsulta($sql);		
	}
	public function getMontoTotal() {
        $sql="SELECT SUM(pt) as suma FROM temporal ORDER BY pt;";
        //print_r($sql);
        return ejecutarConsulta($sql);
    }
    public function getIVA(){
		$sql = "CALL getIVA()";
		return ejecutarConsulta($sql);		
	}
	public function getCantArticulosVenta(){
		$sql = "CALL getCantArticulosVenta()";
		return ejecutarConsulta($sql);		
	}
	public function getInventarioArticulo(){
		$sql = "CALL getInventarioArticulo()";
		return ejecutarConsulta($sql);		
	}





	/* INSERTS */
	public function insertarCliente($nombre, $apellidoPaterno, $apellidoMaterno, $rfc){
		$sql = "CALL insertCliente('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$rfc')";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function insertarArticulo($marca, $modelo, $descripcion, $precio, $existencia){
		$sql = "CALL insertArticulo('$marca', '$modelo', '$descripcion', $precio, $existencia)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function insertarCupon($cupon, $tipoDescuento, $descuento, $aplicado){
		$sql = "CALL insertCupon('$cupon', '$tipoDescuento', $descuento, $aplicado)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function insertarArticuloTemp($cantidad, $pu, $pt, $articuloId){
		$sql = "CALL insertArticuloTemp($cantidad, $pu, $pt, $articuloId)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function insertarIVA($iva){
		$sql = "CALL insertIVA($iva)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function insertarVenta($fecha, $clienteId, $importe, $iva, $descuento, $total, $cupon){
		$sql = "CALL insertVenta('$fecha', $clienteId, $importe, $iva, $descuento, $total, '$cupon')";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 




	/* DELETES */
	public function deteleArticulo($articuloId){
		$sql = "CALL deteleArticulo($articuloId)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function deteleArticulosVenta(){
		$sql = "CALL deteleArticulosVenta()";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function deleteCliente($clienteId){
		$sql = "CALL deleteCliente($clienteId)";
		return ejecutarConsulta($sql);	
	} 





	/* UPDATES */
	public function updateArticulo($articuloId, $marca, $modelo, $descripcion, $precio, $existencia){
		$sql = "CALL updateArticulo($articuloId, '$marca', '$modelo', '$descripcion', $precio, $existencia)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function updateCupon($cupon, $tipoDescuento, $descuento, $aplicado){
		$sql = "CALL updateCupon('$cupon', '$tipoDescuento', $descuento, $aplicado)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function updateArticuloVenta($cantidad, $precioTotal, $temporalId){
		$sql = "CALL updateArticuloVenta($cantidad, $precioTotal, $temporalId)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function updateCuponActivado($cupon){
		$sql = "CALL updateCuponActivado('$cupon')";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function updateCliente($clienteId, $nombre, $apellidoPaterno, $apellidoMaterno, $rfc){
		$sql = "CALL updateCliente($clienteId, '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$rfc')";
		print_r($sql);
		return ejecutarConsulta($sql);	
	} 
	public function updateInventario($articuloId, $cantidad){
		$sql = "CALL updateArticulo($articuloId, $cantidad)";
		//print_r($sql);
		return ejecutarConsulta($sql);	
	} 



}

?>
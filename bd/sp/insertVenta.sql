DROP PROCEDURE IF EXISTS insertVenta;
 
DELIMITER $$
 
CREATE PROCEDURE insertVenta(IN _fecha DATETIME, IN _clienteId INT, IN _importe DECIMAL(10,2), IN _iva DECIMAL(10,2), IN _descuento DECIMAL(10,2), IN _total DECIMAL(10,2), IN _cupon CHAR(10))

BEGIN

	DECLARE _folio INT DEFAULT 0;
	
	/* SE INSERTA LA VENTA */
	INSERT INTO ventas(fecha, cliente_id, importe, iva, descuento, total, cupon) 
				VALUES (_fecha, _clienteId, _importe, _iva, _descuento, _total, _cupon);
				
	/* SE ACTUALIZA EL CUPON A APLICADO */
	UPDATE cupones SET aplicado = 1 WHERE cupon = _cupon; 
	
	/* SE OBTIENE Y RETORNA EL ULTIMO ID INSERTADO */
	SELECT LAST_INSERT_ID() INTO _folio;
	
	/* SE INSERTA EL DETALLE DE LA VENTA */
	INSERT INTO detalle_ventas(folio, articulo_id, cantidad, precio_unitario, precio_total)
	SELECT _folio, articulo_id, cantidad, pu, pt
	FROM temporal;
	
	SELECT _folio;

END $$
DELIMITER ;

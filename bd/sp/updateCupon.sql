DROP PROCEDURE IF EXISTS updateCupon;
 
DELIMITER $$
 
CREATE PROCEDURE updateCupon(IN _cupon CHAR(10), IN _tipoDescuento CHAR(10), IN _descuento DECIMAL(10,2), IN _aplicado INT)

BEGIN
	
	UPDATE cupones
	SET cupon = _cupon, 
		tipo_descuento = _tipoDescuento,
		descuento = _descuento,
		aplicado = _aplicado
	WHERE cupon = _cupon;
									
END $$
DELIMITER ;

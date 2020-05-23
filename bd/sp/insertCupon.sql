DROP PROCEDURE IF EXISTS insertCupon;
 
DELIMITER $$
 
CREATE PROCEDURE insertCupon(IN _cupon CHAR(10), IN _tipoDescuento CHAR(10), IN _descuento DECIMAL(10,2), IN _aplicado INT)

BEGIN

	DECLARE _idCupon INT DEFAULT 0;
	

	/* SE INSERTA EL PRESTAMO */
	INSERT INTO cupones(cupon, tipo_descuento, descuento, aplicado) 
				VALUES (_cupon, _tipoDescuento, _descuento, _aplicado);
	
	/* SE OBTIENE Y RETORNA EL ULTIMO ID INSERTADO */
	SELECT LAST_INSERT_ID() INTO _idCupon;

	
	SELECT _idCupon;

END $$
DELIMITER ;

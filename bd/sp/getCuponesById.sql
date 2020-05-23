DROP PROCEDURE IF EXISTS getCuponesById;
 
DELIMITER $$
 
CREATE PROCEDURE getCuponesById(IN _cupon CHAR(10))

BEGIN

	SELECT 	a.cupon,
			a.tipo_descuento as tipoDescuento, 
			a.descuento, 
			a.aplicado 
	FROM cupones a
	WHERE a.cupon = _cupon;

END $$
DELIMITER ;

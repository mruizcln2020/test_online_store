DROP PROCEDURE IF EXISTS updateCuponActivado;
 
DELIMITER $$
 
CREATE PROCEDURE updateCuponActivado(IN _cupon CHAR(10))

BEGIN
	
	UPDATE cupones
	SET aplicado = 1
	WHERE cupon = _cupon;
									
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS updateIVA;
 
DELIMITER $$
 
CREATE PROCEDURE updateIVA(IN _iva INT)

BEGIN
	
	UPDATE configuracion
	SET iva = _iva;
									
END $$
DELIMITER ;

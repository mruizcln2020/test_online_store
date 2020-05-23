DROP PROCEDURE IF EXISTS insertIVA;
 
DELIMITER $$
 
CREATE PROCEDURE insertIVA(IN _iva INT)

BEGIN

	DELETE FROM configuracion;
	INSERT INTO configuracion(iva) 
				VALUES (_iva);

END $$
DELIMITER ;

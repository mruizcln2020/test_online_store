DROP PROCEDURE IF EXISTS updateArticuloVenta;
 
DELIMITER $$
 
CREATE PROCEDURE updateArticuloVenta(IN _cantidad INT, IN _pt DECIMAL(10,2), IN _temporalId INT)

BEGIN
	
	UPDATE temporal
	SET cantidad = _cantidad, 
		pt = _pt
	WHERE temporal_id = _temporalId;
									
END $$
DELIMITER ;

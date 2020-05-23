DROP PROCEDURE IF EXISTS getCantArticulosVenta;
 
DELIMITER $$
 
CREATE PROCEDURE getCantArticulosVenta()

BEGIN

	SELECT count(*) as cant FROM temporal;

END $$
DELIMITER ;

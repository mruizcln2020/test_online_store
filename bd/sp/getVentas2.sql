DROP PROCEDURE IF EXISTS getVentas2;
 
DELIMITER $$
 
CREATE PROCEDURE getVentas2()

BEGIN

	SELECT 	a.folio, 
			a.fecha,
			a.importe,
			a.iva,
			a.descuento,
			a.total
	FROM ventas a;

END $$
DELIMITER ;

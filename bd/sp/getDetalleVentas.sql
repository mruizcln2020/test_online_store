DROP PROCEDURE IF EXISTS getDetalleVentas;
 
DELIMITER $$
 
CREATE PROCEDURE getDetalleVentas(IN _folio INT)

BEGIN

	SELECT 	a.articulo,
			a.cantidad,
			a.precio_unitario,
			a.precio_total
	FROM detalle_ventas a
	WHERE a.folio = _folio;
		
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getVentas;
 
DELIMITER $$
 
CREATE PROCEDURE getVentas()

BEGIN

	SELECT 	a.folio, 
			a.fecha,
			b.cliente_id as clienteId,
			CONCAT(b.nombre, ' ', b.apellido_paterno, ' ', b.apellido_materno) as cliente,
			a.importe,
			a.iva,
			a.descuento,
			a.total
	FROM ventas a
		INNER JOIN clientes b ON a.cliente_id = b.cliente_id;

END $$
DELIMITER ;

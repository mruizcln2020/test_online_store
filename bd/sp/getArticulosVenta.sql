DROP PROCEDURE IF EXISTS getArticulosVenta;
 
DELIMITER $$
 
CREATE PROCEDURE getArticulosVenta()

BEGIN

	SELECT 	a.temporal_id as temporalId,
		b.articulo_id as articuloId, 
		b.marca,
		b.modelo,
		b.descripcion,
		a.cantidad,
		a.pu,
        a.pt
	FROM temporal a
    	INNER JOIN articulos b ON a.articulo_id = b.articulo_id;

END $$
DELIMITER ;

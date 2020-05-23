DROP PROCEDURE IF EXISTS getArticulosVentaById;
 
DELIMITER $$
 
CREATE PROCEDURE getArticulosVentaById(IN _idArticulo INT)

BEGIN

	SELECT 	a.temporal_id as temporalId, 
			a.cantidad,
			a.articulo_id as articuloId,
			a.pu,
			a.pt
	FROM temporal a
	WHERE a.articulo_id = _idArticulo;

END $$
DELIMITER ;
